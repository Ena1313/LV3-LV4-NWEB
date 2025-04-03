<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * prikaz korisnikovih projekata kao voditelj i kao član
     */
    public function index()
    {
        $vodeni = Auth::user()->vodeniProjekti;
        $clanstva = Auth::user()->projektiClanstva;

        return view('projects.index', compact('vodeni', 'clanstva'));
    }

    /**
     * prikaz forme - stvaranje novog projekta
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * spremanje novog projekta
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cijena' => 'required|numeric',
            'obavljeni_poslovi' => 'nullable|string',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'required|date|after_or_equal:datum_pocetka',
        ]);

        $validated['user_id'] = Auth::id();

        Project::create($validated);

        return redirect()->route('projekti.index')->with('success', 'Projekt je uspješno kreiran.');
    }

    /**
     * prikaz pojedinačnog projekta
     */
    public function show(Project $projekti)
    {
        $this->authorizeAccess($projekti);

        $korisnici = User::where('id', '!=', Auth::id())->get();

        return view('projects.show', [
            'project' => $projekti,
            'korisnici' => $korisnici,
        ]);
    }

    /**
     * prikaz forme za uređivanje projekta
     */
    public function edit(Project $projekti)
    {
        $this->authorizeEdit($projekti);

        return view('projects.edit', ['project' => $projekti]);
    }

    /**
     * ažuriranje postojećeg projekta
     */
    public function update(Request $request, Project $projekti)
    {
        $this->authorizeEdit($projekti);

        if (Auth::id() === $projekti->user_id) {
            $validated = $request->validate([
                'naziv' => 'required|string|max:255',
                'opis' => 'nullable|string',
                'cijena' => 'required|numeric',
                'obavljeni_poslovi' => 'nullable|string',
                'datum_pocetka' => 'required|date',
                'datum_zavrsetka' => 'required|date|after_or_equal:datum_pocetka',
            ]);
            $projekti->update($validated);
        } elseif ($projekti->clanovi->contains(Auth::user())) {
            $validated = $request->validate([
                'obavljeni_poslovi' => 'nullable|string',
            ]);
            $projekti->update(['obavljeni_poslovi' => $validated['obavljeni_poslovi']]);
        }

        return redirect()->route('projekti.show', $projekti)->with('success', 'Projekt je ažuriran.');
    }

    /**
     * brisanje projekta dopusteno samo voditelju
     */
    public function destroy(Project $projekti)
    {
        if (Auth::id() !== $projekti->user_id) {
            abort(403, 'Samo voditelj projekta može obrisati projekt.');
        }

        $projekti->delete();

        return redirect()->route('projekti.index')->with('success', 'Projekt je obrisan.');
    }

    /**
     * dodavanje člana projektnom timu
     */
    public function dodajClana(Request $request, Project $projekti)
    {
        if (Auth::id() !== $projekti->user_id) {
            abort(403, 'Samo voditelj može dodavati članove.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $projekti->clanovi()->syncWithoutDetaching([$validated['user_id']]);

        return back()->with('success', 'Član je dodan projektu.');
    }

    /**
     * provjera prava pristupa
     */
    private function authorizeAccess(Project $project)
    {
        if (
            Auth::id() !== $project->user_id &&
            !$project->clanovi->contains(Auth::id())
        ) {
            abort(403, 'Nemate pristup ovom projektu.');
        }
    }

    /**
     * provjera prava uređivanja
     */
    private function authorizeEdit(Project $project)
    {
        if (
            Auth::id() !== $project->user_id &&
            !$project->clanovi->contains(Auth::id())
        ) {
            abort(403, 'Nemate pravo uređivanja ovog projekta.');
        }
    }
}

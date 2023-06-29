<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $events = Event::query()->orderBy('start_date', 'desc')->get();
        return view('panel.admin.events.index', compact('events'))
            ->with(['nav_item' => 'events', 'nav_link' => 'events']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'title' => ['required', 'max:100'],
            'desc' => ['required', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:' . now(), 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'reward_for_register' => ['required', 'numeric', 'min:0'],
            'reward_for_file' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        Event::query()->create([
            'title' => $request->title,
            'desc' => $request->desc,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reward_for_register' => $request->reward_for_register,
            'reward_for_file' => $request->reward_for_file,
            'by_admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        $event = Event::query()->find($id);

        return view('panel.admin.events.show', compact('event'))
            ->with(['nav_item' => 'events', 'nav_link' => 'events']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $event = Event::query()->find($id);

        return view('panel.admin.events.edit', compact('event'))
            ->with(['nav_item' => 'events', 'nav_link' => 'events']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'title' => ['required', 'max:100'],
            'desc' => ['required', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:' . now(), 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'reward_for_register' => ['required', 'numeric', 'min:0'],
            'reward_for_file' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $event = Event::query()->find($id);
        $event->title = $request->title;
        $event->desc = $request->desc;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->reward_for_register = $request->reward_for_register;
        $event->reward_for_file = $request->reward_for_file;
        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Event::destroy($id);
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully');
    }
}

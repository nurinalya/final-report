<?php

namespace App\Http\Controllers;

use App\Models\StudySession;
use App\Models\HelpRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $studySessions = StudySession::with('user')->latest()->get();
        $mySessions = StudySession::where('user_id', $user->id)->with('user')->latest()->get();
        $helpRequests = HelpRequest::with('user')->latest()->get();
        $myHelpRequests = HelpRequest::where('user_id', $user->id)->latest()->get();

        $totalActiveGroups = StudySession::where('status', 'upcoming')->count();
        $totalJoinedSessions = StudySession::sum('joined_count');
        $openHelpRequests = HelpRequest::where('status', 'open')->count();
        $trackedCourses = StudySession::distinct('course_code')->count('course_code');

        return Inertia::render('Dashboard', [
            'studySessions' => $studySessions,
            'mySessions' => $mySessions,
            'helpRequests' => $helpRequests,
            'myHelpRequests' => $myHelpRequests,
            'stats' => [
                'totalActiveGroups' => $totalActiveGroups,
                'totalJoinedSessions' => $totalJoinedSessions,
                'openHelpRequests' => $openHelpRequests,
                'trackedCourses' => $trackedCourses,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => ['required', 'string', 'max:20'],
            'topic' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:study_group,help_wanted'],
            'location' => ['required', 'string', 'max:500'],
            'session_date' => ['required', 'date'],
            'session_time' => ['required', 'string', 'max:10'],
            'max_slots' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $validated['user_id'] = auth()->id();
        $validated['available_slots'] = $validated['max_slots'];
        $validated['joined_count'] = 0;
        $validated['status'] = 'upcoming';

        StudySession::create($validated);

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Study group created successfully!',
        ]);
    }

    public function update(Request $request, StudySession $studySession)
    {
        if ($studySession->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'course_code' => ['required', 'string', 'max:20'],
            'topic' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:study_group,help_wanted'],
            'location' => ['required', 'string', 'max:500'],
            'session_date' => ['required', 'date'],
            'session_time' => ['required', 'string', 'max:10'],
            'max_slots' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $validated['available_slots'] = $validated['max_slots'];

        $studySession->update($validated);

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Study group updated successfully!',
        ]);
    }

    public function destroy(StudySession $studySession)
    {
        if ($studySession->user_id !== auth()->id()) {
            abort(403);
        }

        $studySession->delete();

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Study group deleted successfully!',
        ]);
    }

    public function join(Request $request, StudySession $studySession)
    {
        if ($studySession->available_slots < 1) {
            return redirect()->to(route('dashboard'))->with('flash', [
                'error' => 'This session is full.',
            ]);
        }

        $studySession->decrement('available_slots');
        $studySession->increment('joined_count');

        if ($studySession->available_slots === 0) {
            $studySession->update(['status' => 'full']);
        }

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => "You've joined {$studySession->topic}!",
        ]);
    }

    public function storeHelpRequest(Request $request)
    {
        $validated = $request->validate([
            'course_code' => ['required', 'string', 'max:20'],
            'topic' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'open';
        $validated['response_count'] = 0;

        HelpRequest::create($validated);

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Help request posted successfully!',
        ]);
    }

    public function updateHelpRequest(Request $request, HelpRequest $helpRequest)
    {
        if ($helpRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'course_code' => ['required', 'string', 'max:20'],
            'topic' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'string', 'in:open,in_progress,resolved'],
        ]);

        $helpRequest->update($validated);

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Help request updated successfully!',
        ]);
    }

    public function destroyHelpRequest(HelpRequest $helpRequest)
    {
        if ($helpRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $helpRequest->delete();

        return redirect()->to(route('dashboard'))->with('flash', [
            'success' => 'Help request deleted successfully!',
        ]);
    }
}

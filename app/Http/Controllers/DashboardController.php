<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use App\Http\Requests\SettingRequest;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Spatie\Permission\Models\Role;


class DashboardController extends Controller
{
    /**
    * Show dashboard
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Task $task)
    {

        $logs = Activity::where('causer_id', auth()->id())->latest()->paginate(5);
        $members = User::count();
        $roles = Role::count();
        $tasks = Task::count();
        $jobs= Task::all();
        $categories = Category::count();
        $category_1 = Task::where('category_id', 1)->count();
        $category_2 = Task::where('category_id', 2)->count();
        $cat1Complete = Task::where('category_id', 1)
                        ->whereNotNull('file_jamlak') 
                        ->whereNotNull('file_kontrak') 
                        ->whereNotNull('file_sprin_pc') 
                        ->whereNotNull('file_pc') 
                        ->whereNotNull('file_izin_bekal') 
                        ->whereNotNull('file_sprin_komisi') 
                        ->whereNotNull('file_bek') 
                        ->whereNotNull('file_komisi') 
                        ->whereNotNull('file_bagudang') 
                        ->whereNotNull('file_pem_gudang') 
                        ->whereNotNull('file_bast') 
                        ->whereNotNull('file_lpp') 
                        ->whereNotNull('file_pemerataan')          
                        ->count();

        $cat1NotComplete=Task::where('category_id', 1)
                        ->orWhereNull('file_jamlak') 
                        ->orWhereNull('file_kontrak') 
                        ->orWhereNull('file_sprin_pc') 
                        ->orWhereNull('file_pc') 
                        ->orWhereNull('file_izin_bekal') 
                        ->orWhereNull('file_sprin_komisi') 
                        ->orWhereNull('file_bek') 
                        ->orWhereNull('file_komisi') 
                        ->orWhereNull('file_bagudang') 
                        ->orWhereNull('file_pem_gudang') 
                        ->orWhereNull('file_bast') 
                        ->orWhereNull('file_lpp') 
                        ->orWhereNull('file_pemerataan')          
                        ->count();

        $cat2Complete = Task::where('category_id', 2)

                        ->whereNotNull('file_jamlak') 
                        ->whereNotNull('file_kontrak') 
                        ->whereNotNull('file_sprin_pc') 
                        ->whereNotNull('file_pc') 
                        ->whereNotNull('file_izin_bekal') 
                        ->whereNotNull('file_sprin_komisi') 
                        ->whereNotNull('file_bek') 
                        ->whereNotNull('file_komisi') 
                        ->whereNotNull('file_bagudang') 
                        ->whereNotNull('file_pem_gudang') 
                        ->whereNotNull('file_bast') 
                        ->whereNotNull('file_lpp') 
                        ->whereNotNull('file_pemerataan')          
                        ->count();
        //chart
        $items = [];
        $data = [];

        foreach($jobs as $job){
            $items[] = $job->title;
            // $data[] = $jobs->
        }
        // dd(json_encode($items));
        return view('admin.dashboard', compact('logs', 'members', 'roles', 'tasks', 'categories', 'cat1Complete', 'cat1NotComplete', 'cat2Complete', 'category_1', 'category_2',
                                    'items'));
    }

    /**
    * Show activity logs
    *
    * @return \Illuminate\Http\Response
    */
    public function activity_logs()
    {
        $logs = Activity::where('causer_id', auth()->id())->latest()->paginate(10);

        return view('admin.logs', compact('logs'));
    }

	/**
	* Store settings into database
	*
	* @param $request
    * @return \Illuminate\Http\Response
	*/
    public function settings_store(SettingRequest $request)
    {
    	// when you upload a logo image
    	if($request->file('logo')) {
	    	$filename = $request->file('logo')->getClientOriginalName();
	    	$filePath = $request->file('logo')->storeAs('uploads', $filename, 'public');
	    	setting()->set('logo', $filePath);
    	}

    	setting()->set('site_name', $request->site_name);
    	setting()->set('keyword', $request->keyword);
    	setting()->set('description', $request->description);
    	setting()->set('url', $request->url);

    	// save all
    	setting()->save();
    	return redirect()->back()->with('success', 'Settings has been successfully saved');
    }

    /**
    * Update profile user
    *
    * @param $request
    * @return \Illuminate\Http\Response
    */
    public function profile_update(Request $request)
    {
        $data = ['name' => $request->name];

        // if password want to change
        if($request->old_password && $request->new_password) {
            // verify if password is match
            if(!Hash::check($request->old_password, auth()->user()->password)) {
                session()->flash('failed', 'Password is wrong!');
                return redirect()->back();
            }

            $data['password'] = Hash::make($request->new_password);
        } 

        // for update avatar
        if($request->avatar) {
            $data['avatar'] = $request->avatar;

            if(auth()->user()->avatar) {
                unlink(storage_path('app/public/'.auth()->user()->avatar));
            }
        }
        
        // update profile
        auth()->user()->update($data);
        
        return redirect()->back()->with('success', 'Profile updated!');
    }

    /**
    * Store avatar images into database
    *
    * @param $request
    * @return string
    */
    public function upload_avatar(Request $request)
    {
        $request->validate(['avatar'  => 'file|image|mimes:jpg,png,svg|max:1024']);

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');

            $fileName = $file->getClientOriginalName();
            $folder = 'user-'.auth()->id();

            $file->storeAs('avatars/'.$folder, $fileName, 'public');

            return 'avatars/'.$folder.'/'.$fileName;
        }

        return '';
        
    }

    public function delete_logs()
    {
        // $logs = Activity::where('created_at', '<=', Carbon::now()->subWeeks())->delete();
        $logs = Activity::truncate();
        return back()->with('success', 'All Logs successfully deleted!');
    }
}

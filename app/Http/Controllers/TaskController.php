<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index','store']]);
         $this->middleware('permission:task-create', ['only' => ['create','store']]);
         $this->middleware('permission:task-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:task-delete', ['only' => ['destroy']]);
         $this->middleware('permission:manage-list', ['only' => ['manage']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tasks.index',[
            // 'tasks' => Task::all(),
            'categories_1' =>Task::where('category_id', 1)->paginate(5),
            'categories_2' =>Task::where('category_id', 2)->paginate(5),
            
        ]);
    }

    public function manage(Task $task)
    {  
 
        return view('admin.tasks.manage',[
            'tasks' => Task::all(),
            'categories_1' =>Task::where('category_id', 1)->paginate(5),
            'categories_2' =>Task::where('category_id', 2)->paginate(5),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tasks.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:tasks',
            'file' => 'mimes:pdf,png,jpg|file|max:4096',
            'due_date' => 'required',
            'category_id' => '',
            'body' => 'max:2000',
            'price' => 'required|integer',
        ]);
        $validatedData['user_id'] = auth()->user()->id;

        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('post-files');
        }

        Task::create($validatedData);
        return redirect('/admin/tasks')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {   
        return view('admin.tasks.show',
            ['task' => $task,]
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('admin.tasks.edit', [
            'task' => $task,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Task $task)
    {   
        //storing files 
        $rules = [
            'file_jamlak' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_kontrak' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_jamuk' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_sprin_pc' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_pc' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_izin_bekal' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_sprin_komisi' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_bek' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_komisi' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_bagudang' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_pem_gudang' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_bast' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_lpp' => 'mimes:pdf,png,jpg|file|max:4096',
            'file_pemerataan' => 'mimes:pdf,png,jpg|file|max:4096',
        ];

        //validate rules in to new variable
        $validatedData = $request->validate($rules);

        // //update file func
        // function updateFile($strFileName, $oldFileName, $file_name, Request $request){
        //     if($request->file($strFileName)){
        //         if($request->$oldFileName){
        //             Storage::delete($request->$oldFileName);
        //             return $request;
        //         }
        //         $validatedData[$strFileName] = $request->file($strFileName)->store('post-files');
        //         $validatedData[$file_name] = auth()->user()->name;
    
        //     }
        // }
        // switch($request->send_track){
        //     case 'jamlak' : updateFile('file_jamlak', 'oldJamlak', 'jamlak_name', $request);
        //                     break;
        // }

        //jamlak
        if($request->file('file_jamlak')){
            if($request->oldJamlak){
                Storage::delete($request->oldJamlak);
                // return $request->oldJamlak;
            }
            $validatedData['file_jamlak'] = $request->file('file_jamlak')->store('post-files');
            $validatedData['jamlak_name'] = auth()->user()->name;

        }

        //kontrak
        if($request->file('file_kontrak')){
            if($request->oldKontrak){
                Storage::delete($request->oldKontrak);
            }
            $validatedData['file_kontrak'] = $request->file('file_kontrak')->store('post-files');
            $validatedData['kontrak_name'] = auth()->user()->name;

        }

        //jamuk
        if($request->file('file_jamuk')){
            if($request->oldJamuk){
                Storage::delete($request->oldJamuk);
            }
            $validatedData['file_jamuk'] = $request->file('file_jamuk')->store('post-files');
            $validatedData['jamuk_name'] = auth()->user()->name;

        }

        //sprin pc
        if($request->file('file_sprin_pc')){
            if($request->oldSprin_pc){
                Storage::delete($request->oldSprin_pc);
            }
            $validatedData['file_sprin_pc'] = $request->file('file_sprin_pc')->store('post-files');
            $validatedData['sprin_pc_name'] = auth()->user()->name;

        }

        //pc
        if($request->file('file_pc')){
            if($request->oldPC){
                Storage::delete($request->oldPC);
            }
            $validatedData['file_pc'] = $request->file('file_pc')->store('post-files');
            $validatedData['pc_name'] = auth()->user()->name;

        }

        //izin bekal
        if($request->file('file_izin_bekal')){
            if($request->oldIzin_bekal){
                Storage::delete($request->oldIzin_bekal);
            }
            $validatedData['file_izin_bekal'] = $request->file('file_izin_bekal')->store('post-files');
            $validatedData['izin_bekal_name'] = auth()->user()->name;

        }

        //sprin komisi
        if($request->file('file_sprin_komisi')){
            if($request->oldSprin_komisi){
                Storage::delete($request->oldSprin_komisi);
            }
            $validatedData['file_sprin_komisi'] = $request->file('file_sprin_komisi')->store('post-files');
            $validatedData['sprin_komisi_name'] = auth()->user()->name;
        }

        //osbek
        if($request->file('file_bek')){
            if($request->oldOsbek){
                Storage::delete($request->oldOsbek);
            }
            $validatedData['file_bek'] = $request->file('file_bek')->store('post-files');
            $validatedData['bek_name'] = auth()->user()->name;
        }
        
        // komisi
        if($request->file('file_komisi')){
            if($request->oldKomisi){
                Storage::delete($request->oldKomisi);
            }
            $validatedData['file_komisi'] = $request->file('file_komisi')->store('post-files');
            $validatedData['komisi_name'] = auth()->user()->name;
        }

        //bagudang
        if($request->file('file_bagudang')){
            if($request->oldBagudang){
                Storage::delete($request->oldBagudang);
            }
            $validatedData['file_bagudang'] = $request->file('file_bagudang')->store('post-files');
            $validatedData['bagudang_name'] = auth()->user()->name;
        }

        //pem_gudang
        if($request->file('file_pem_gudang')){
            if($request->oldPem_gudang){
                Storage::delete($request->oldPem_gudang);
            }
            $validatedData['file_pem_gudang'] = $request->file('file_pem_gudang')->store('post-files');
            $validatedData['pem_gudang_name'] = auth()->user()->name;
        }

        //bast
        if($request->file('file_bast')){
            if($request->oldBast){
                Storage::delete($request->oldBast);
            }
            $validatedData['file_bast'] = $request->file('file_bast')->store('post-files');
            $validatedData['bast_name'] = auth()->user()->name;
        }

        //lpp
        if($request->file('file_lpp')){
            if($request->oldLpp){
                Storage::delete($request->oldLpp);
            }
            $validatedData['file_lpp'] = $request->file('file_lpp')->store('post-files');
            $validatedData['lpp_name'] = auth()->user()->name;
        }

        //pemerataan
        if($request->file('file_pemerataan')){
            if($request->oldPemerataan){
                Storage::delete($request->oldPemerataan);
            }
            $validatedData['file_pemerataan'] = $request->file('file_pemerataan')->store('post-files');
            $validatedData['pemerataan_name'] = auth()->user()->name;
        }
        
        //add user id
        $validatedData['user_id'] = auth()->user()->id;

        //update orm
        Task::where('id', $task->id)
        ->update($validatedData);
        
        return redirect('/admin/tasks')->with('success', 'New post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {   
        if($task->file){
            Storage::delete($task->file);
        }
        if($task->file_jamlak){
            Storage::delete($task->file_jamlak);
            Storage::delete($task->file_kontrak);
            Storage::delete($task->file_jamuk);
            Storage::delete($task->file_pc);
            Storage::delete($task->file_izin_bekal);
            Storage::delete($task->file_sprin_pc);
            Storage::delete($task->file_sprin_komisi);
            Storage::delete($task->file_bek);
            Storage::delete($task->file_komisi);
            Storage::delete($task->file_bagudang);
            Storage::delete($task->file_pem_gudang);
            Storage::delete($task->file_bast);
            Storage::delete($task->file_lpp);
            Storage::delete($task->file_pemerataan);
        }
        
        Task::destroy($task->id);
        
        return redirect('/admin/tasks')->with('success', 'Task has been deleted!');
    }


    private function processDelete($strname, $strfile, $file)
    {
        $dell = Task::where($strfile, 'post-files/' . $file)->first();

        Storage::delete($dell->$strfile);

        $dell->update([$strfile => null,
                        $strname => null]);
    }
    
    public function delete_file($file, $track)
    {   
           switch($track){
                case 1: $this->processDelete('jamlak_name', 'file_jamlak', $file);
                    break;
                case 2: $this->processDelete('kontrak_name', 'file_kontrak', $file);
                    break;
                case 3: $this->processDelete('jamuk_name', 'file_jamuk', $file);
                    break;
                case 4: $this->processDelete('kontrak_name', 'file_sprin_pc', $file);
                    break;
                case 5: $this->processDelete('sprin_pc_name', 'file_pc', $file);
                    break;
                case 6: $this->processDelete('pc_name', 'file_izin_bekal', $file);
                    break;
                case 7: $this->processDelete('izin_bekal_name', 'file_sprin_komisi', $file);
                    break;
                case 8: $this->processDelete('bek_name', 'file_bek', $file);
                    break;
                case 9: $this->processDelete('komisi_name', 'file_komisi', $file);
                    break;
                case 10: $this->processDelete('bagudang_name', 'file_bagudang', $file);
                    break;
                case 11: $this->processDelete('pem_gudang_name', 'file_pem_gudang', $file);
                    break;
                case 12: $this->processDelete('bast_name', 'file_bast', $file);
                    break;
                case 13: $this->processDelete('lpp_name', 'file_lpp', $file);
                    break;
                case 14: $this->processDelete('pemerataan_name', 'file_pemerataan', $file);
                    break;
                default:
                    null;
           }
        // print_r($deleteFile);
        return redirect()->back();
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Task::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
 
}

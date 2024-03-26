<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDocumentRequest;
use App\Http\Requests\Admin\Masters\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::latest()->get();
        return view('admin.masters.documents')->with(['documents'=> $documents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Document::create( Arr::only( $input, Document::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Document created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Document');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        if ($document)
        {
            $response = [
                'result' => 1,
                'document' => $document
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $document->update( Arr::only( $input, Document::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Document updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Document');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        try
        {
            DB::beginTransaction();
            $document->delete();
            DB::commit();
            return response()->json(['success'=> 'Document deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Document');
        }
    }
}

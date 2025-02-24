<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReasonRequest;
use App\Http\Requests\UpdateAndStoreCategoryRequest;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Reason;

class ReasonsController extends  Controller
{
    public function index()
    {
        $reasons = Reason::paginate(5);

        return view('admin.reasons.index', [
            'reasons' => $reasons
        ]);
    }

    public function delete(Reason $reason)
    {
        try {
            Complaint::query()->where("reason_id",$reason->id)->delete();
            $reason->delete();
        }
        catch (\Exception $exception){
            return redirect()->route('admin.reasons.index')->with('error', 'Не удалось удалить причину жалобы!');
        }
        return redirect()->route('admin.reasons.index')->with('success', 'Причина жалобы успешно удалена!');
    }


    public function store(StoreReasonRequest $request)
    {
        try{
            Reason::create($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('admin.reasons.index')->with('error', 'Ошибка добавления причины жалобы!');
        }

        return redirect()->route('admin.reasons.index')->with('success', 'Причина успешно добавлена!');
    }


    public function create()
    {
        return view('admin.reasons.create');
    }

    public function edit(Reason $reason)
    {
        return view('admin.reasons.edit', ['reason' => $reason]);
    }


    public function update(StoreReasonRequest $request, Reason $reason)
    {
        try{
            $reason->update($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('admin.reasons.index')->with('error', 'Не удалось изменить причину!');
        }

        return redirect()->route('admin.reasons.index')->with('success', 'Причина успешно изменёна!');
    }
}

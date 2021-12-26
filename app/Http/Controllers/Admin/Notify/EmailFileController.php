<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;

class EmailFileController extends Controller
{

    public function index(Email $email)
    {
        return view('admin.notify.email-file.index', compact('email'));
    }

    public function create(Email $email)
    {
        return view('admin.notify.email-file.create', compact('email'));
    }


    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            if ($request->input('file_path') == 'public') {
                $result = $fileService->moveToPublic($request->file('file'));
            } else {
                $result = $fileService->moveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false) {
                return redirect()->route('admin.notify.email-file.index', $email->id)
                    ->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            }
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        $email->files()->create($inputs);
        return redirect()->route('admin.notify.email-file.index', $email->id)
            ->with('swal-success', 'فایل با موفقیت به ایمیل مورد نظر وصل شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(EmailFile $file)
    {
        return view('admin.notify.email-file.edit', compact('file'));
    }


    public function update(EmailFileRequest $request, EmailFile $file, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            if (!empty($file->file_path)) {
                $storagePath = storage_path($file->file_path);
                if (file_exists($storagePath)) {
                    $fileService->deleteFile($file->file_path, true);
                } else {
                    $fileService->deleteFile($file->file_path);
                }
            }
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            if ($request->input('file_path') == 'public') {
                $result = $fileService->moveToPublic($request->file('file'));
            } else {
                $result = $fileService->moveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false) {
                return redirect()->route('admin.notify.email-file.index', $file->email->id)
                    ->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            }
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        $file->update($inputs);
        return redirect()->route('admin.notify.email-file.index', $file->email->id)
            ->with('swal-success', 'فایل با موفقیت تغییر کرد');
    }

    public function destroy(EmailFile $file)
    {
        $file->delete();
        return redirect(route('admin.notify.email-file.index', $file->email->id))
            ->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }

    public function status(EmailFile $file)
    {
        $file->status = $file->status == 0 ? 1 : 0;
        $result = $file->save();
        if ($result) {
            if ($file->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}

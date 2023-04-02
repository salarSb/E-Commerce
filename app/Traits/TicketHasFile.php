<?php

namespace App\Traits;

use App\Http\Services\File\FileService;

trait TicketHasFile
{
    protected FileService $fileService;
    protected ?int $fileSize = null;
    protected string|bool|null $fileMoveResult;
    protected ?string $fileFormat = null;

    public function setFileService(FileService $fileService): static
    {
        $this->fileService = $fileService;
        return $this;
    }

    public function moveFileAndSetData($path, $file)
    {
        $this->fileService->setExclusiveDirectory($path);
        $this->fileService->setFileSize($file);
        $this->fileSize = $this->fileService->getFileSize();
        $this->fileMoveResult = $this->fileService->moveToPublic($file);
        $this->fileFormat = $this->fileService->getFileFormat();
    }

    public function createTicketFile(int $ticketId)
    {
        auth()->user()->ticketFiles()->create([
            'file_path' => $this->fileMoveResult,
            'file_size' => $this->fileSize,
            'file_type' => $this->fileFormat,
            'status' => 1,
            'ticket_id' => $ticketId,
        ]);
    }
}

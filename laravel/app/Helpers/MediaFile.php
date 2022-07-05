<?php
namespace App\Helpers;

use Illuminate\Http\Request;

class MediaFile
{
    public string $filenameWithExtention;
    public string $filename;
    public string $fileExtention;
    public string $fileMimeType;
    public string $fileType;
    public string $filenameToStore;

    public function __Construct (Request $request)
    {
        return [
            $this->filenameWithExtention = $request->file('media')->getClientOriginalName(),
            $this->filename = pathinfo($this->filenameWithExtention, PATHINFO_FILENAME),
            $this->fileExtention = $request->file('media')->getClientOriginalExtension(),
            $this->fileMimeType = $request->file('media')->getMimeType(),
            $this->fileType = explode('/', $this->fileMimeType)[0],
            $this->filenameToStore = 'storage/media/' . time() . '.' . $this->fileExtention,
        ];
    }
}

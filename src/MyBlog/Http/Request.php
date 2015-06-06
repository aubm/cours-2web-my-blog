<?php

namespace MyBlog\Http;

class Request
{
    /**
     * @return RequestFile[]
     */
    public function getRequestFilesFromGlobals()
    {
        $files_to_return = [];

        foreach ($_FILES as $key_name => $file_data) {
            if ($file_data['error'] !== 4) {
                $request_file = new RequestFile();

                $request_file->setName($file_data['name']);
                $request_file->setTmpName($file_data['tmp_name']);
                $request_file->setType($file_data['type']);
                $request_file->setSize($file_data['size']);
                $request_file->setError($file_data['error']);

                $files_to_return[$key_name] = $request_file;
            }
        }

        return $files_to_return;
    }

    /**
     * @return string|boolean
     */
    public function moveAndRenameUploadedFile(RequestFile $request_file, $destination_folder)
    {
        $moved_file_name = $this->generateUniqueNameForFile($request_file);
        if (!move_uploaded_file($request_file->getTmpName(), $destination_folder . '/' . $moved_file_name)) {
            return false;
        }
        return $moved_file_name;
    }

    /**
     * @return string
     */
    private function generateUniqueNameForFile(RequestFile $request_file)
    {
        $unique_name = uniqid();

        $file_name_parts = explode('.', $request_file->getName());
        if (count($file_name_parts) > 1) {
            $file_extension = end($file_name_parts);
            $unique_name .= '.' . $file_extension;
        }

        return $unique_name;
    }


}
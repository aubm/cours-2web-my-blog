<?php

namespace MyBlog\Http;

class Request
{
    /**
     * $_FILES est la superglobale où des informations concernant les fichiers
     * joints à la requête HTTP sont extraites. Ces informations sont accesssibles
     * sous la forme de tableaux associatifs imbriqués. Pour une question pratique,
     * nous préférons manipuler des objets représentant ces informations.
     * C'est la raison pour laquelle la classe \MyBlog\Http\RequestFile a été introduite.
     * La méthode \MyBlog\Http\Request::getRequestFilesFromGlobals() analyse le contenu
     * de la superglobale $_FILES, construit un tableau d'objets de type
     * \MyBlog\Http\RequestFile à partir de ce contenu et retourne ce tableau.
     *
     * @return RequestFile[]
     */
    public function getRequestFilesFromGlobals()
    {
        $files_to_return = [];

        foreach ($_FILES as $key_name => $file_data) {
            /* La liste exhaustive des status d'erreur est disponible dans la documentation
               de PHP : http://php.net/manual/fr/features.file-upload.errors.php */
            if ($file_data['error'] !== UPLOAD_ERR_NO_FILE) {
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
     * Cette méthode déplace un fichier de requête vers un répertoire de destination.
     * Un nouveau nom généré semi-aléatoirement pour le fichier.
     *
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
     * Cette méthode génère une chaine de caractères unique qui sera utilisée
     * pour renommer le fichier à déplacer dans la méthode moveAndRenameUploadedFile().
     * L'extension du nom du fichier d'origine est conservé et ajoutée à la fin de cette
     * chaîne de caractères.
     *
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
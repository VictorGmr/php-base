<?php

namespace Modules\Core\Scaffold\Support;

use Illuminate\Support\Str;
use Nwidart\Modules\Exceptions\FileAlreadyExistException;
use Nwidart\Modules\Generators\FileGenerator;
use Nwidart\Modules\Support\Stub;

class Scaffold
{
    private $domain;
    private $module;

    private $basePath;
    private $stubBasePath;

    private $tempFolderViewName;

    /**
     * Options
     */
    private $force;
    private $api;
    private $noview;
    private $nocontroller;

    public function __construct(string $domain, string $module, bool $force = false, bool $api = false, $noview = false, $nocontroller = false)
    {
        $this->domain = $domain;
        $this->module = $module;
        $this->basePath = config('modules.stubs.base_path');

        $this->force = $force;
        $this->api = $api;
        $this->noview = $noview;
        $this->nocontroller = $nocontroller;

        if($api){
            $this->stubBasePath = config('modules.stubs.path_scaffold').'/api';
        }else{
            $this->stubBasePath = config('modules.stubs.path_scaffold').'/web';
        }
    }

    /**
     * CREATE
     */
    public function generate()
    {
        if(!file_exists($this->basePath.'/Modules/'.$this->module)){
            return false;
        }
        $this->getDirContents($this->stubBasePath);
        return true;
    }

    private function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $this->createFile($path);
                $results[] = "FILE: ".$path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = "DIR: ".$path;
            }
        }
        return $results;
    }

    private function createFile($path)
    {
        $folderViewName = $this->folderView($this->domain);
        $domainEnum     = str_replace('-','_',$folderViewName);

        $relative   = str_replace($this->stubBasePath, '',$path);

        $arr        =   explode(DIRECTORY_SEPARATOR,$relative);
        $file       =   $arr[count($arr)-1];
        $folder     =   str_replace($file, '',$relative);

        /**
         * Skip View
         */
        if($this->noview){
            if($folder == "/Resources/views/" || $folder == '/Resources/views/livewire/'){
                return true;
            }
        }

        /**
         * Skip Controller
         */
        if($this->nocontroller){
            if($folder == "/Http/Controllers/" || $folder == "/Http/Requests/"){
                return true;
            }
        }

        $stubRenderName = $folder.$file;

        $Stub = new Stub($stubRenderName, [
            'SKELETON' => $this->domain,
            'SKELETONMODELNAME' => lcfirst($this->domain),
            'MODULE' => $this->module,
            'MODULELOWER' => strtolower($this->module),
            'MODULEDOMAINLOWER' => $domainEnum,
            'MODULEDOMAINUPPER' => strtoupper($domainEnum),
            'FOLDERVIEW' => $folderViewName,
        ]);

        $Stub::setBasePath($this->stubBasePath);
        $contents = $Stub->render();

        $fileName = str_replace('stub',  'php', $file);
        $fileName = str_replace('Skeleton',  $this->domain, $fileName);

        if($folder == '/Routes/' || $folder == '/Resources/views/livewire/' || $folder == '/Breadcrumbs/'){
            $fileName = str_replace('skeleton',  $folderViewName, $fileName);
        }

        if($folder == "/Database/Migrations/"){
            $date = date('Y_m_d_His');
            $fileName = $date."_".str_replace('skeleton',  $domainEnum, $fileName);
        }

        $pathGenerateFile = $this->basePath.'/Modules/'.$this->module.$folder.$fileName;

        if($folder == '/Resources/views/'){
            if(!file_exists($this->basePath.'/Modules/'.$this->module.$folder.$folderViewName)){
                mkdir($this->basePath.'/Modules/'.$this->module.$folder.$folderViewName,0777, true);
            }
            $pathGenerateFile = $this->basePath.'/Modules/'.$this->module.$folder.$folderViewName."/".$fileName;
        }

        if($folder == '/Resources/views/livewire/'){
            $livewireFolder = $this->basePath.'/Modules/'.$this->module.'/Resources/views/'.$folderViewName.'/livewire';
            if(!file_exists($livewireFolder)){
                mkdir($livewireFolder,0777, true);
            }
            $pathGenerateFile = $livewireFolder."/".$fileName;
        }

        try {
            if($this->force || !file_exists($pathGenerateFile)){
                (new FileGenerator($pathGenerateFile, $contents))
                    ->withFileOverwrite($this->force)->generate();
                echo "created: ".$pathGenerateFile."\n";
            }else{
                echo "existing: ".$pathGenerateFile."\n";
            }
        } catch (FileAlreadyExistException $e) {
            return E_ERROR;
        }
    }

    /**
     * DELETE
     */

    public function delete()
    {
        if(!file_exists($this->basePath.'/Modules/'.$this->module)){
            return false;
        }
        $this->getDirContentsForDelete($this->stubBasePath);
        if (file_exists($this->tempFolderViewName)) {
            unlink($this->tempFolderViewName);
        }
        return true;
    }

    private function getDirContentsForDelete($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $this->deleteFile($path);
                $results[] = "FILE: ".$path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContentsForDelete($path, $results);
                $results[] = "DIR: ".$path;
            }
        }
        return $results;
    }

    private function deleteFile($path)
    {
        $folderViewName = $this->folderView($this->domain);
        $this->tempFolderViewName = $folderViewName;
        $domainEnum     = str_replace('-','_',$folderViewName);

        $relative   = str_replace($this->stubBasePath, '',$path);

        $arr        =   explode(DIRECTORY_SEPARATOR,$relative);
        $file       =   $arr[count($arr)-1];
        $folder     =   str_replace($file, '',$relative);

        $fileName = str_replace('stub',  'php', $file);
        $fileName = str_replace('Skeleton',  $this->domain, $fileName);

        if($folder == '/Routes/' || $folder == '/Resources/views/livewire/' || $folder == '/Breadcrumbs/'){
            $fileName = str_replace('skeleton',  $folderViewName, $fileName);
        }

        if($folder == "/Database/Migrations/"){
            $fileName = str_replace('skeleton',  $domainEnum, $fileName);
            $files = scandir($this->basePath.'/Modules/'.$this->module."/Database/Migrations");
            foreach ($files as $key => $value) {
                $prefix = Str::before($value,$fileName);
                if($prefix != $value){
                    $fileName = $prefix.$fileName;
                }
            }
        }

        $pathGenerateFile = $this->basePath.'/Modules/'.$this->module.$folder.$fileName;
        if($folder == '/Resources/views/'){
            if(!file_exists($this->basePath.'/Modules/'.$this->module.$folder.$folderViewName)){
                mkdir($this->basePath.'/Modules/'.$this->module.$folder.$folderViewName,0777, true);
            }
            $pathGenerateFile = $this->basePath.'/Modules/'.$this->module.$folder.$folderViewName."/".$fileName;
        }

        if($folder == '/Resources/views/livewire/'){
            $livewireFolder = $this->basePath.'/Modules/'.$this->module.'/Resources/views/'.$folderViewName.'/livewire';
            if(!file_exists($livewireFolder)){
                mkdir($livewireFolder,0777, true);
            }
            $pathGenerateFile = $livewireFolder."/".$fileName;
        }

        if(file_exists($pathGenerateFile)){
            unlink($pathGenerateFile);
            echo "Deleted: ".$pathGenerateFile."\n";
        }
    }

    /**
     *
     */

    private function normalize($attribute)
    {
        $result = '';

        $attribute = strtolower($attribute);
        $explodes = explode('_', $attribute);
        foreach ($explodes as $word) {
            if (empty($result)) {
                $result .= $word;
            } else {
                $result .= ucfirst($word);
            }
        }
        return $result;
    }

    private function folderView($property)
    {
        $result = '';

        $explodes = preg_split('/(?=[A-Z])/', $property);
        foreach ($explodes as $word) {
            if (empty($result)) {
                $result .= $word;
            } else {
                $result .= '-' . strtolower($word);
            }
        }
        return strtolower($result);
    }
}

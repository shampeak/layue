<?php
namespace app\common\Traits;

trait Readme {

    /*
     * readme
     */
    function readme()
    {
        $file = APP_PATH.strtolower($this->chr).DS.'Readme.md';
        $text = file_get_contents($file);
        $par = new \Parsedown();
        $text = $par->text($text);
        return view('../../common/tempfile/readme',[
            'text'      => $text
        ]);
    }

}

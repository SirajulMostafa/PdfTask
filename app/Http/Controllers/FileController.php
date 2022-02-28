<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\File;
use Illuminate\Support\Str;
class FileController extends Controller
{
   public function index() { 
      return view('file');

   }
   public function store(Request $request) {

        $file = $request->file;

        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);

        // use of pdf parser to read content from pdf 
        $fileName = $file->getClientOriginalName();

      $pdfParser = new Parser();
      $pdf = $pdfParser->parseFile($file->path());
      $content = $pdf->getText();
      $search_key = 'Handover Confirmed';
      $contains =Str::contains($content,$search_key);
      if($contains==false){
         return redirect()->back()->with('error', 'Not Found Handover Date');
      }
      else{
         $content = Str::after($content,$search_key);
         $output = '';
         $content_to_array=  array_map('trim',array_filter(explode(' ',$content)));
         foreach($content_to_array as $key=> $val){
           // $val!=null && $val!=':'&& 
            if(Str::length($val)==10){
               $output=$content_to_array[$key];
              break;
            }
       }
           $fileObject = new File;
           $fileObject->Search_key= $search_key;  
           $fileObject->Handover_date =$output;
           $fileObject->save();
           return redirect()->back()->with('success', 'File  submitted    '
           ."search_key:  ".$search_key.
           "   Handover Date: ".$output);
   

      }
     }

}

<?php

namespace AscentCreative\Geo\Controllers;

use AscentCreative\CMS\Controllers\AdminBaseController;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Admin\UI\Index\Column;

class CountryController extends AdminBaseController
{

    static $modelClass = 'AscentCreative\Geo\Models\Country';
    static $bladePath = "cms::admin.countries";

    public $indexSort = 'name';
    public $indexSearchFields = ['name'];

    
    public function __construct() {
       
        // register index filters

    }

  
    public function origcommitModel(Request $request, Model $model)
    {

        parent::commitModel($request, $model); // auto-commit the fillable field data;


    }


    public function rules($request, $model=null) {

       return [
            'name' => 'required', //|unique:App\Models\Work,title' . ($model?(',' . $model->id):''),
           
        ]; 

    }


    public function autocomplete(Request $request) {

        // Should this be encapsulated in a 'search' method on the model?
        //  - would allow all search formats to always use the same fields. Handy for the index filters. 
        $term = $request->term;
        $cls = $this::$modelClass;
        $data = $cls::where('name', 'like', '%' . $term . '%')
                      ->get();

        // Can't easily concat fields etc without making a raw query
        // Not keen on that for security, so we'll loop and assign the label here.
        // Plus, we get the benefit of using the model accessor.
        foreach($data as $row) {
            $row['label'] = $row->name;
        }

        return $data;

    }

   

}
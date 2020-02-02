## Larevel Update Large number of rows using pagination
```
$limit = 500;
$total_pages = ceil( Model::where("status","0")->count() / $limit);
try{
    for($i = 1; $i <= $total_pages ; $i++){
        $chunk = Model::where("status","0")->forPage($i, $limit);
        $rows = $chunk->get();
        foreach ($rows as $row) {
            $row->update(['status' => 1]);
        }
    }
}catch(\PDOException $e){
    //
}
```

## Laravel pagination append url parameter
```
{{ $users->appends(request()->query())->links() }}
```

## Laravel 2 paginations in 1 page
```
Model1::paginate(15, ['*'], 'param1');
Model2::paginate(15, ['*'], 'param2');
```
## Laravel helper functions
```
$user = Auth::user(); $no_user = User::find(0);
$str = "Lorem ipsum doler sit"; $num = 1; $blank = '';

echo blank($num).' - '.blank($blank); // - 1
// Here $blank is null so it return 1. 

echo camel_case($str); // loremIpsumDolerSit
echo kebab_case($str); // lorem-ipsum-doler-sit
echo snake_case($str); // lorem_ipsum_doler_sit
echo str_slug($str); // lorem-ipsum-doler-sit
echo studly_case($str); // LoremIpsumDolerSit
echo title_case($str); // Lorem Ipsum Doler Sit

echo optional($user)->name.' - '.optional($user)->blahblah.' - '.optional($no_user)->name; // user - - 
// option returns null if object or key/column of object is not found

```
## Laravel export CSV
```
$headers = [
   'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
   'Content-type' => 'application/vnd.ms-excel',
   'Content-Disposition' => 'attachment; filename=file_name.xlsx',
   'Expires' => '0',
   'Pragma' => 'public'
];
$list = TableModel::all()->toArray();
# add headers for each column in the CSV download
array_unshift($list, array_keys($list[0]));
$callback = function() use ($list) {
   $FH = fopen('php://output', 'w');
     foreach ($list as $row) {
     fputcsv($FH, $row);
   }
   fclose($FH);
};
return Response::stream($callback, 200, $headers);
```

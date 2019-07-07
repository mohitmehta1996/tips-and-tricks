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

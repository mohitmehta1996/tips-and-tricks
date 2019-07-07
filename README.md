# tips-and-tricks
Some useful Laravel, PHP, Mysql tips and tricks

# Mysql Get duplicate rows
```
SELECT email, COUNT(email) FROM users GROUP BY email HAVING COUNT(email) > 1 
```

# Mysql Delete duplicate rows - Method 1
```
DELETE t1 FROM users t1
        INNER JOIN
    users t2 
WHERE
    t1.id < t2.id AND t1.email = t2.email;
```

# Mysql Delete duplicate rows - Method 2
```
CREATE TABLE source_copy LIKE source;
```
```
INSERT INTO source_copy
SELECT * FROM source
GROUP BY col; -- column that has duplicate values
```
```
Step3. DROP TABLE source;
ALTER TABLE source_copy RENAME TO source;
```

# Larevel Update Large number of rows using pagination
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

# Php simple encryption-decryption
```
function url_encrypt($string, $key=5) {
    $result = '';
    for($i=0, $k= strlen($string); $i<$k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}
function url_decrypt($string, $key=5) {
    $result = '';
    $string = base64_decode($string);
    for($i=0,$k=strlen($string); $i< $k ; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}
```

# Laravel pagination append url parameter
```
{{ $users->appends(request()->query())->links() }}
```

# Remove Malformed UTF-8 characters, possibly incorrectly encoded
```
function convert_from_latin1_to_utf8_recursively($dat){
    if (is_string($dat)) {
        return utf8_encode($dat);
    }elseif (is_array($dat)) {
        $ret = [];
        foreach ($dat as $i => $d) $ret[ $i ] = convert_from_latin1_to_utf8_recursively($d);
        return $ret;
    }elseif (is_object($dat)) {
        foreach ($dat as $i => $d) $dat->$i = convert_from_latin1_to_utf8_recursively($d);
        return $dat;
    }else {
        return $dat;
    }
}
```

# Laravel 2 paginations in 1 page

```
Model1::paginate(15, ['*'], 'param1');
Model2::paginate(15, ['*'], 'param2');
```


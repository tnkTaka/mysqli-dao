# Mysqli Dao
mysqli dao using in php
- - - -
## Usage
### SELECT
```
$db = new DB();

$sql = "SELECT id, name FROM player WHERE name = ?";
$types = "s";
$name = "hoge";
$params = array($name);

$res = $db->query($sql, true, $types, $params);
while ($row = $res->fetch_assoc()){
    var_dump($row);
}
```

### Other
```
$db = new DB();

$sql = "INSERT INTO player(name) VALUES (?);";
$types = "s";
$name = "hoge";
$params = array($name);

$res = $db->other($sql,true,$types,$params);
var_dump($res);
```

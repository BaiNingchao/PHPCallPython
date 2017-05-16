
<?php
/*echo "Hello Tom!";
$action=$_GET['action'];
echo "document.write('".$action."');n";*/
/*class Test{
    function test1($name){
    echo "Hello my name is:\t".$name."\n";
    }

    function test2($name,$age)
    {
        echo "My name is:\t".$name.",I am :\t".$age.".";
    }
}

$obj = new Test();
$obj->test1("BNC");*/

    // phpinfo();
?>
<?php
class Car{
    var $name;
    var $age;
    function callname(){
        $this->name="张三";
        $this->age = 12;
        echo "我的名字叫：".$this->name."<br />"."我的年龄是：".$this->age;
    }
    function call($name,$age){
        $this->name = $name;
        $this->age = $age;
        echo "我的名字叫[：".$name."<br />"."我的年龄是[：".$age;
    }
}
$p1=new Car;
$p1->call('sddf','23');
?>


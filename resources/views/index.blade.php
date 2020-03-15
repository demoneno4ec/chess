<?php
use Symfony\Component\Debug\Exception\FatalThrowableError;ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

class ParentObject
{
    public $test = 1;
    protected $testSub1;

    public function setValue($value)
    {
        $this->testSub1 = $value;
    }

    public function getValue()
    {
        return $this->testSub1;
    }

    public function desctroyValue()
    {
        unset($this->testSub1);
    }
}
class SubObject1 extends ParentObject
{
    public $test = 'test';
    protected $testSub1;
}
class SubObject2 extends ParentObject
{
    public $test = ['auto'];
    public $testSub1;
}


function castToObject($instance, $className)
{
    validateInstance($instance);
    validateClassName($className);

    return unserialize(
        sprintf(
            'O:%d:"%s"%s',
            strlen($className),
            $className,
            strstr(
                strstr(
                    serialize($instance),
                    '"'
                ),
                ':'
            )
        ),
        [
            'allow_classes' => [
                'ParentObject',
                'SubObject1',
                'SubObject2'
            ]
        ]
    );
}
function validateInstance($instance)
{
    if (!is_object($instance)) {
        throw new InvalidArgumentException(
            'Argument 1 must be an Object'
        );
    }
}
function validateClassName($className)
{
    if (!class_exists($className)) {
        throw new InvalidArgumentException(
            'Argument 2 must be an existing Class'
        );
    }
}
function showArrows()
{
    echo '<div class="arrows">';
    echo '<div class="arrow">';
    echo '&dHar;';
    echo '</div>';
    echo '<div class="arrow">';
    echo '&dHar;';
    echo '</div>';
    echo '<div class="arrow">';
    echo '&dHar;';
    echo '</div>';
    echo '<div class="arrow">';
    echo '&dHar;';
    echo '</div>';
    echo '<div class="arrow">';
    echo '&dHar;';
    echo '</div>';
    echo '</div>';
}

$parentObject = new ParentObject();
$subObject1 = new SubObject1();
$subObject1->setValue('$bar');
$subObject2 = new SubObject2();
$subObject2->setValue('bar2');


dump($subObject1);
$bar = castToObject($subObject1, 'ParentObject');
showArrows();
dump($bar);

$bar->setValue('newBar');
dump($bar->getValue());
dump($bar);

$bar = castToObject($bar, 'SubObject1');
showArrows();
dump($bar);
dump($bar->getValue());

echo '- - - - - - - - - - -';

dump($subObject2);
$bar = castToObject($subObject2, 'ParentObject');
showArrows();
dump($bar);

dump('Cannot access protected property ParentObject::$testSub1 ');
$bar->setValue('newBar');
dump($bar->getValue());
dump($bar);

$bar = castToObject($bar, 'SubObject2');
showArrows();
dump($bar);
dump($bar->getValue());

$bar->desctroyValue();
dump($bar);
dump($bar->getValue());




$list = collect();

$list->push(typeCasting(0));
$list->push(typeCasting(false));
$list->push(typeCasting(1));
$list->push(typeCasting(true));
$list->push(typeCasting(0.0));
$list->push(typeCasting(0.1));
$list->push(typeCasting(0.2));
$list->push(typeCasting(1.0));
$list->push(typeCasting(0.1 + 0.2));
$list->push(typeCasting(0.1 + 0.2 == 0.3));
$list->push(typeCasting(''));
$list->push(typeCasting('false'));
$list->push(typeCasting('true'));
$list->push(typeCasting("true"));
$list->push(typeCasting("false"));
$list->push(typeCasting("01"));
$list->push(typeCasting("0-1"));
$list->push(typeCasting("-1e3"));
$list->push(typeCasting("0.1+0.2"));
$list->push(typeCasting([]));
$list->push(typeCasting([1, 2, 'string']));
$list->push(typeCasting(['string' => [1, 2,], 'temp' => 'asd']));
$list->push(typeCasting(new ParentObject()));
$list->push(typeCasting(null));

$list = $list->groupBy(function ($item, $key) {
    return $item[1];
});
function typeCasting($testVariable)
{
    $type = gettype($testVariable);

    $variable = [
        print_r($testVariable, 1),
        print_r($type, 1),
        print_r((int) $testVariable, 1),
        print_r((bool) $testVariable, 1),
        print_r((float) $testVariable, 1),
        print_r((string) $testVariable, 1),
        print_r((array) $testVariable, 1),
        print_r((object) $testVariable, 1),
        gettype((unset) $testVariable),

    ];

    return $variable;
}
?>

<table>
    <thead>
    <tr>
        <th>Значение переменной</th>
        <th>type</th>
        <th>integer</th>
        <th>boolean</th>
        <th>float</th>
        <th>string</th>
        <th>array</th>
        <th>object</th>
        <th>null</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($list)){
    foreach($list as $group => $variable){?>
    <tr class="group-title">
        <td colspan="9">
            <?=$group?>
        </td>
    </tr>
    <?php foreach($variable as $columns){?>
    <tr>
        <?php foreach($columns as $column){?>
        <td>
            <?php echo $column?>
        </td>
        <?php }?>
    </tr>
    <?php }?>
    <?php }
    }else{?>
    List is empty
    <?php }
    ?>
    </tbody>
</table>


<style>
    table {
        text-align: center;
        border-collapse: collapse;
    }

    table thead {
        background-color: #cacaca;
    }

    table td, th {
        padding: 4px 8px;
        border: unset;
    }

    tr.group-title {
        font-size: 1.1em;
        font-weight: bold;
        background-color: #f7f7f7;
    }

    table tr:not(.group-title) + tr:not(.group-title) {
        border-top: 1px solid #cacaca;
    }

    pre {
        margin: 0;
    }

    .arrows {
        display: flex;
        align-items: center;
        max-width: 26vw;
        justify-content: space-around;
        background-color: #18171b;
        color: #fff;
        border: 1px solid;
    }
</style>

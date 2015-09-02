
### 使用Doctrine的生命周期
在Model 的注视中，添加 "@ORM\HasLifecycleCallbacks"

在setCreateAt
@ORM\PrePersist() 在每次PrePersist()之前进行复制
$this->createAt = new \DateTime();

建议很多地方使用这个特性的话，
建议写一个PrePersist()方法

```php
/**
 * @ORM\PrePersist()
 */
public function PrePersist(){

    if($this->getCreateAt() == null){
        $this->setCreateAt(new \DateTime('now'));
    }
    $this->setUpdateAt(new \DateTime('now'));

}

/**
 * @ORM\PreUpdate()
 */
public function PreUpdate(){
    $this->setUpdateAt(new \DateTime('now'));
}
```

在Doctrine的文档10.2章节中列举了所有操作的时间点

10-6
每次更新数据之前，建议 --dump-sql一下看看是否是需要更详细的，避免把原来的数据删除了


课程演示操作
1. 新增一本书
2. 更新书2的价格

@ORM\PreUpdate()是更新之前做的事情

```php
$em = $this->getDoctrine()->getManager();
//新增一本书，并且修改"程序思维"这本书的价格
/** @var  $book2 \Hello\WebBundle\Entity\Book */
$book2 = $this->getBookRepository()->findOneBy(array('title'=>'程序员思维'));
$book2->setPrice(30);


$newBook = new Book();
$newBook->setTitle("PHP Mysql权威指南")->setPrice(98.00);

$em->persist($book2);
$em->persist($newBook);
$em->flush();
```

10-7
如果方法有很多createAt或者UpdateAt的花
建议建立一个基类放@ORM\PrePersist()和@ORM\PreUpdate()这些方法
 

//Doctrine的插件
github DoctrineExtensions
StofDoctrineExtensionsBundle进行管理Extension
sluggable 文章标题
有时间的话，可以研究研究


------


###10-8
使用sql进行查询
$this->get('database_connection')->fetchAll(sql);
返回是原生mysql的结果集，没有Model的get和set方法

###10-9 手动控制事务
```php
$em = $this->getDoctrine()->getManager();
$em->getConnection()->beginTransaction();

try{

    //新增一本书，并且修改"程序思维"这本书的价格
    /** @var  $book2 \Hello\WebBundle\Entity\Book */
    $book2 = $this->getBookRepository()->findOneBy(array('title'=>'程序员思维'));
    $book2->setPrice(35);


    $newBook = new Book();
    $newBook->setTitle("PHP Mysql权威指南")->setPrice(99.00);

    $em->persist($book2);
    $em->persist($newBook);
    $em->flush();
    $em->getConnection()->commit();
}catch (Exception $e){
    $em->getConnection()->rollback();
}
```

###10-10
$sql = "select b,u from ScourgenWebBundle:Book b join b.users u";
mysql 原生结构集

在项目后期进行这样的做法，做优化

###10-11
在Dql中使用partial
$sql = "select partial b.{id,title},u.{} from ScourgenWebBundle:Book b
 join b.users u";

###10-12
使用构造方法进行创建对象
构造函数不建议太多参数，多余5,6个就不太好

##10-13
$query = $this->getDoctrine()
->getManager()
->createQuery('Select u form ScourgenWebBundle:user u');

`var_dump($query->getResult());exit();`

`Debug::dump($query->getResult());exit();`使用这个进行替换来调试查询的信息

在工作中常用的方法介绍了


##11-2 构成表单的几个元素
M
- 数据模型
V
- 表单的html代码，css样式,js效果等。
C
- 负责表单逻辑处理的代码


Model

1. 真实存在的存放在数据库中的数据
2. 虚拟的数据模型： 如:搜索框

数据模型组成部分：属性（类型、限制条件）


##11-3 View

##11-4 Controller
数据验证逻辑，可以是自己定义的验证

##11-5 创建表单

action code

```
$user = new User();
$form = $this->createFormBuilder($user)
        ->add('email')
        ->add('password')
        ->add('age')
        ->add('Submit','submit')
        ->getForm();
//处理form的轻轻
$form->handleRequest($this->getRequest());

//假如表单验证成功
if($form->isValid()){
    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();
}

return array('name' => 'a','form'=>$form->createView());
```

在views里面`{{ form($form) }}` 使用twing中的form方法显示form变量



###11-6 创建Form
表单嵌套
```
$user = new User();
$builder = $this->createFormBuilder($user);
//form中添加user对应的profile
$form = $builder
        ->add('email')
        ->add('password')
        ->add('age')
        ->add(
            $builder->create('profile','form')
                ->add('phone_number','integer')
        )
        ->add('Submit','submit')
        ->getForm();
//处理form的请求
$form->handleRequest($this->getRequest());

//假如表单验证成功
if($form->isValid()){
    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();
}

return array('name' => 'a','form'=>$form->createView());
```
字段类型源码在:`vendor/symfony/symfony/src/Component/Form/Extension/Core/Type`


显示Form字段的模板在: `vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/view/Form`

[Karışık Depoo](https://t.me/karisikdepooyazilim)
# Micro Framework

Güncelleme v1.0.2

### Kurulum

1. Projenin klasörünü oluşturun. ör: deneme-framework

Bunlar gerekli değil ama git ile clonelamanızı tavsiye ederim

2. Git'i indirin [Git'in sitesine git](https://git-scm.com/)

3. Git'i kurun kurulum aşamasında path e eklemeyi unutmayın

4. Projenin klasöründe terminal ya da uç birim, cmd vs yani consoleunuzu açın ve projenin dizinine gidin.
 
```sh 
git clone https://github.com/omerfarukbicer0446/framework
``` 
bunu yapıştırın indirme tamamlanmasını bekleyin.

5. İndirme bittikten sonra Linux,Windows ve MacOS için `cd framework` bunu elle de yapabilirsiniz sizin tercihiniz.

6. framework klasörüne gittikten sonra `composer install` yaparak gerekli tüm kütüphaneleri indirebilirseniz

NOT: Eğer composer.json dosyasını sildiyseniz
```sh 
1. composer require vlucas/phpdotenv
2. composer require jenssegers/blade
``` 
yukardakileri sırasıyla kurunuz ya da sırası fark etmez :)

artık her şey hazır son aşama .env dosyasını kendinize göre doldurun ve artık frameworkten hiç bir hata almazsınız.

### Micro Framework'un Micro Dökümantasyonu

#### Controllers/Models/Views yönetimi

Yeni bir route oluşturma public/web.php ye girmelisiniz

```php
$router->get('/merhaba', function(){
    echo 'Merhaba dünya';
});
```

Yeni bir view oluşturma:

yukardada yaptığımız gibi

```php
$router->get('/merhaba-yeni', function(){
    echo 'Merhaba dünya';
});
```

bu kodu aynen yeni bir route oluşturuyoruz ve Merhaba dünya yazdıran yere 

```php
Route::view('merhaba'); // app/views/merhaba.blade.php adında dosya arar

// view in içerisine değer göndermek için
Route::view('merhaba', ['title' => 'merhaba']);
```

ve son hali şöyle olmalıdır.
```php
$router->get('/merhaba-yeni', function(){
    Route::view('merhaba');
});
```

Controller oluşturma.

```php
Route::controller('merhaba@dunya');
// Bu şekilde kullanırsanız app/controllers/merhaba.php den merhaba classının içindeki dunya fonksiyonunu çalıştıracaktır.
Route::controller('yeni-merhaba');
// Bu şekilde kullanırsanız app/controllers/yeni-merhaba.php den yeni-merhaba classının içindeki index fonksiyonunu çalıştıracaktır.

// controller a değer göndermek için
Route::controller('merhaba@dunya', ['title' => 'merhaba']);
```

Model oluşturma.

```php
Route::model('merhaba@dunya');
// Bu şekilde kullanırsanız app/model/merhaba.php den merhaba classının içindeki dunya fonksiyonunu çalıştıracaktır.
Route::model('yeni-merhaba');
// Bu şekilde kullanırsanız app/model/yeni-merhaba.php den yeni-merhaba classının içindeki getAll fonksiyonunu çalıştıracaktır.

// model'e değer göndermek için
Route::model('merhaba@dunya', ['title' => 'merhaba']);
```

#### Ufak helperlar

Yönlendirme işlemleri
```php
redirect('https://www.cibza.com'); // header('Location: https://www.cibza.com'); değeri ile eş değer
redirect('https://www.cibza.com',3); // header('Refresh: 3; url=https://www.cibza.com'); değeri ile eş değer redirect fonksiyonun 2. parametresine ne yazarsanız o sürede yönlendirme işlemi yapılır.
```

Şuanki zamandan belirtilen zamanın aralığını hesaplar
```php
// Bu fonksiyonun doğru cevap vermesi için .env dosyasını TIMEZONE değişkenini kendinize göre ayarlamayı unutmayın.
timeAgo('01.01.2021'); // Çıktısı 8 gün önce olucaktır Benim timezone'uma göre 'Europe/Istanbul' bu türkiye'nin genel saatini verir. 
```

Büyük sayıları düzenli bi biçimde yazma
```php
numberConverter(100); // Çıktısı 100
numberConverter(1000); // Çıktısı 1 B
numberConverter(10000); // Çıktısı 10 B
numberConverter(100000); // Çıktısı 100 B
numberConverter(1000000); // Çıktısı 1 Mn 
numberConverter(10000000); // Çıktısı 10 Mn 
numberConverter(100000000); // Çıktısı 100 Mn 
numberConverter(1000000000); // Çıktısı 1 Mr 
numberConverter(10000000000); // Çıktısı 10 Mr
numberConverter(100000000000); // Çıktısı 100 Mr
numberConverter(1000000000000); // Çıktısı 1 Tn
numberConverter(10000000000000); // Çıktısı 10 Tn
numberConverter(100000000000000); // Çıktısı 100 Tn

// 100 Tn den sonrasını normal bi biçimde yazar
```

Permalink - Seflink 
```php
permalink('Ömer Faruk Biçer'); // Çıktısı omer-faruk-bicer
permalink('Ömer Faruk Biçer',[
  'delimiter' => '-', // Boşlukları neye çevireceğini sorar
  'limit' => null, // Buraya ne girilirse integer değer olmak süretiyle o karakter sayısından sonrasını siler
  'lowercase' => true, // true ise hepsini küçük yazar false ise değerin küçük harf ve büyük harfine karışmaz
  'replacements' => array(), // İstediğiniz bir harfi neye dönüştürmek istiyorsanız array bir değer ile belirtmeniz lazım
  'transliterate' => true // Bunun bir açıklaması yok :)
]);
```

#### 404 error page

`core/static/404.php` yi kendinize göre istediğiniz gibi yapın

#### Html e link ile dosya çağırma ve script ile de

style ve script dosyalarını public klasörü altında dilediğiniz gibi tutabilirsiniz. ve resimlerinizde orada olabilir :)

```html
<!-- link -->
<link href="public/stylesheets/*" rel="stylesheet">
<!-- images -->
<img src="public/images/*">
<!-- script -->
<script src="public/scripts/*">
```

#### Blade

Gerekli basit işlemler
```php
{{ $x }} // değişkenin değerini yazar

{{-- Yorum satırı --}} // Yorum satırı olur

@if($x == $x)
    <p>Hello World</p>
@endif // Php deki if blokları için
```

Switch case yapısı 

```php
@switch($i)
    @case(1)
        First case...
        @break

    @case(2)
        Second case...
        @break

    @default
        Default case...
@endswitch
```

Döngüler 

```php
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I m looping forever.</p>
@endwhile
```

İnclude

```php
@include('welcome')
```

Daha detaylı dökümantasyon için [Laravel'git](https://laravel.com/docs/8.x/blade)


[Karışık Depoo](https://t.me/karisikdepooyazilim)

# Laravel Support

Support and helpers for Laravel projects.

## Installation

This package can be installed through Composer:

``` bash
composer require samwrigley/laravel-support
```

## Usage

### Traits

The follow traits are available when using this package:

| Trait | Code | Description
| --- | --- | --- |
| `CanBePublished` | [View](src/Traits/CanBePublished.php) | [Read](#canbepublished) |
| `HasAuthor` | [View](src/Traits/HasAuthor.php) | [Read](#hasauthor) |
| `HasCategories` | [View](src/Traits/HasCategories.php) | [Read](#hascategories) |
| `HasCategory` | [View](src/Traits/HasCategory.php) | [Read](#hascategory) |
| `HasPaths` | [View](src/Traits/HasPaths.php) | [Read](#haspaths) |

#### CanBePublished

To use the `CanBePublished` trait, add it to your model as follows:

``` php
use SamWrigley\Support\Traits\CanBePublished;

class Article {
    use CanBePublished;

    ...
}
```

You'll also need to add the `published_at` column to the corresponding table. For example:

``` php
Schema::create('article', function (Blueprint $table) {
    ...
    $table->dateTimeTz('published_at')->nullable();
    ...
});
```

Once added, the trait makes all of the following methods available on the model.

You can easily publish, schedule or draft an item using the following methods:

``` php
$article->publish()
// Publish item

$article->publish($dateTime)
// Scheduled item to be published at given dateTime

$article->draft()
// Draft item
```

You can easily check if an item is published, scheduled or a draft using the following methods:

``` php
$article->isPublished()
// Check if item is published

$article->isScheduled()
// Check if item is scheduled to be published

$article->isDraft()
// Check if item is a draft
```

The trait also adds numerous local scopes to help when querying the model:

``` php
$articles->published()->get();
// Get all published items

$articles->scheduled()->get();
// Get all scheduled items

$articles->draft()->get();
// Get all draft items

$articles->month($month)->get();
// Get all items published in a given month

$articles->year($year)->get();
// Get all items published in a given year

$articles->whereBetween($then, $now)->get();
// Get all items published between the given dateTimes

$articles->whereBefore($now)->get();
// Get all items published before the given dateTime

$articles->whereAfter($then)->get();
// Get all items published after the given dateTime
```

Of course, local scopes can also be chained together if needed, for example:

``` php
$articles->month('January')->year('2018')->get();
// Get all items published in January 2018
```

#### HasAuthor

To use the `HasAuthor` trait, add it to your model as follows:

``` php
use SamWrigley\Support\Traits\HasAuthor;

class Article {
    use HasAuthor;

    ...
}
```

Then, define the author relationship by adding an `author()` method to the model.

Once added, the trait adds the helper method `withAuthor()` to eager load the `author` relationship:

``` php
$article->withAuthor()->get();
```

#### HasCategories

To use the `HasCategories` trait, add it to your model as follows:

``` php
use SamWrigley\Support\Traits\HasCategories;

class Article {
    use HasCategories;

    ...
}
```

Then, define the categories relationship by adding a `categories()` method to the model.

Once added, the trait adds the helper method `withCategories()` to eager load the `categories` relationship:

``` php
$article->withCategories()->get();
```

Also available, are the `addCategories()` and `updateCategories()` helper methods:

``` php
$article->addCategories($categories);
// Assign given categories to article

$article->updateCategories($categories);
// Update given categories on article
```

#### HasCategory

To use the `HasCategory` trait, add it to your model as follows:

``` php
use SamWrigley\Support\Traits\HasCategory;

class Article {
    use HasCategory;

    ...
}
```

Then, define the category relationship by adding a `category()` method to the model.

Once added, the trait adds the helper method `withCategory()` to eager load the `category` relationship:

``` php
$article->withCategory()->get();
```

Also available, are the `addCategory()` and `removeCategory()` helper methods:

``` php
$article->addCategory($category);
// Assign given category to article

$article->removeCategory();
// Remove category from article
```

#### HasPaths

To use the `HasPaths` trait, add the following to your model:

``` php
use SamWrigley\Support\Traits\HasPaths;

class Article {
    use HasPaths;

    /**
     * The route namespaces.
     *
     * @var array
    */
    protected $namespaces = [
        'web' => 'blog',
        'admin' => 'admin.blog',
    ];

    ...
}
```

The `namespaces` property allows you to define the default route namespaces for your model. Both the `web` and `admin` namespaces are required, however, you can add additional namespaces if you're overwriting the default method parameters, as explained below. The value of each namespace should reflect your model's route namespacing.

Once added, the trait adds the follow methods to the model:

``` php
$article->createPath();
$article->storePath();
$article->showPath();
$article->editPath();
$article->updatePath();
$article->destroyPath();
```

Each method returns the corresponding full CRUD path, for example:

``` php
$article->showPath();
// https://samwrigley.co.uk/blog/example

$article->updatePath();
// https://samwrigley.co.uk/admin/blog/1
```

Here's an example usage:

``` php
<a href="{{ $article->showPath() }}">
    {{ $article->title }}
<a/>
```

You can also overwrite the default parameters for any of the `HasPaths` methods by passing in an associative array.

In the following example we're getting the full show path for an article in the admin rather than on the front-end. Note, we're also changing the route key name from the article's `slug` to `id`:

``` php
$article->showPath([
    'key' => 'id',
    'namespace' => 'admin',
]);
// https://samwrigley.co.uk/admin/blog/1
```

The array passed in as a parameter is merged with the default parameters; you therefore only need define the key/value pairs that you wish to overwrite.

## Testing

Run the tests with:

``` bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

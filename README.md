# Module.TemplateEmail
A pattern for building emails using Twig templates.


### Creating a Twig Template Email

Create a class that extends TwigTemplateEmail and a template file with the extension .twig.

```
MyExampleEmail.php
AnExample.twig
```


The .twig file is the HTML of the email. Twig adds functionality to HTML without jumping in-and-out of PHP. This allows the HTML to remain independent and be tested without a running program.    

The Email class constructor must call `parent::__construct` with the location of the .html or .twig file it will use.  
```php
public function __construct(User $recipient)
    {
        $this->recipient = $recipient;

        parent::__construct(__DIR__ . '/AnExample.twig');
    }
```

To pass your data into an email you need to implement the `getData()` method and return an array of items you wish to pass through. 

```php
protected function getData(): array
    {
        return [
            "recipient" => $this->recipient,
            "date" => new RhubarbDate(),
        ];
    }
```

### Using Twig 

Twig uses brackets `{  }` to insert variables and controls into a HTML template.   

A variable can be output directly using double brackets. 
```twig
<p>{{ date }}</p>
```

Objects can be access with dot notation in the same way:
```twig
<p>Dear {{ recipient.Name }},</p>
```


Controls can be added using `{%  %}`.

```twig
{% for purchase in purchases  %}
    {% if purchase.cancelled %}
        <p class="red">You cancelled your purchase of a {{purchase.product}} on {{purchase.date}}
    {% else %}
        <p> you purchased a {{purchase.product}} on {{purchase.date}} for {{purchase.price}}</p>
    {% endif %}
{% endfor %}
```

Full Twig Documentation:
https://twig.symfony.com/doc/2.x/




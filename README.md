# apache log parser library

## Install

Using composer:

```
php composer.phar require jkh/apache-log-parser-library:~1.0
```

## Usage

Simply instantiate the class :

```php
$parser = new \jkh\ApacheLogParser\ApacheLogParser();
```

And then parse the lines of your access log file :

```php
$log_file = '/var/log/apache2/access.log';

$handle = fopen($log_file, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $entry = $parser->parse($line);
    }
    fclose($handle);
} else {
    echo "An error occurred: unable to open the file!\n";
}
```

Where `$entry` object will hold all data parsed.

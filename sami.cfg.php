<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Laravel')
    //->exclude('Traits')
    ->in($dir = __DIR__.'/../lavacharts/src');

$versions = GitVersionCollection::create($dir)
    //->addFromTags('2.5.2')
    ->add('dashboards', 'v3.0 branch');

$options = [
    'theme'                => 'lava',
    //'versions'             => $versions,
    'title'                => 'Lavacharts API',
    'build_dir'            => __DIR__.'/build/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
    //'remote_repository'    => new GitHubRemoteRepository('khill/lavacharts', dirname($dir)),
    'default_opened_level' => 2,
];

$sami = new Sami($iterator, $options);

$templates = $sami['template_dirs'];
$templates[] = __DIR__ . '/themes/';

$sami['template_dirs'] = $templates;

return $sami;

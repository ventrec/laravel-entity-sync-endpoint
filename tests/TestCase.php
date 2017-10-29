<?php

namespace Ventrec\LaravelEntitySyncEndpoint\Test;

use Illuminate\Database\Schema\Blueprint;
use Mockery;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Ventrec\LaravelEntitySyncClient\LaravelEntitySyncClientProvider;
use Ventrec\LaravelEntitySyncEndpoint\Test\Models\Article;
use Ventrec\LaravelEntitySyncEndpoint\Test\Models\Page;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->registerMocks();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelEntitySyncClientProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('queue.default', 'sync');
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => $this->getTempDirectory() . '/database.sqlite',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

        $app['config']->set('laravelEntitySyncEndpoint.entities', [
            'article' => Article::class,
            'page' => Page::class,
        ]);

        $app['config']->set('laravelEntitySyncEndpoint.routeUrlPrefix', '');
        $app['config']->set('laravelEntitySyncEndpoint.api_auth_token', null);
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();

        $this->createTables('articles', 'pages');
        $this->seedModels(Article::class, Page::class);
    }

    protected function resetDatabase()
    {
        file_put_contents($this->getTempDirectory().'/database.sqlite', null);
    }

    public function getTempDirectory()
    {
        return __DIR__ . '/temp';
    }

    protected function createTables(...$tableNames)
    {
        collect($tableNames)->each(function ($tableName) {
            $this->app['db']->connection()->getSchemaBuilder()->create($tableName, function (Blueprint $table) use ($tableName) {
                $table->increments('id');
                $table->string('name')->nullable();

                if ($tableName === 'pages') {
                    $table->timestamp('deleted_at')->nullable();
                }

                $table->timestamps();
            });
        });
    }

    protected function seedModels(...$modelClasses)
    {
        collect($modelClasses)->each(function ($modelClass) {
            foreach (range(1, 0) as $index) {
                $modelClass::create(['name' => "name {$index}"]);
            }
        });
    }

    public function doNotMarkAsRisky()
    {
        $this->assertTrue(true);
    }

    private function registerMocks()
    {
        Mockery::mock('App\Http\Controllers\Controller');
    }
}

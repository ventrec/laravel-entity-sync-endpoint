<?php

namespace Ventrec\LaravelEntitySyncEndpoint\Test;

use Ventrec\LaravelEntitySyncEndpoint\Test\Models\Article;
use Ventrec\LaravelEntitySyncEndpoint\Test\Models\Page;

class BasicTest extends TestCase
{
    public function testCheckIfDataExistsInTheDatabase()
    {
        $articles = Article::all();

        $this->assertEquals(2, $articles->count());
    }

    public function testCheckIfEntityIsCreated()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/PostRequest.json'), true);

        $this->call('POST', '/entity-sync', $data);

        $articles = Article::all();

        $this->assertEquals(3, $articles->count());
    }

    public function testCheckIfEntityIsUpdated()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/UpdateArticleRequest.json'), true);

        $this->call('PATCH', '/entity-sync', $data);

        $article = Article::findOrFail(2);

        $this->assertEquals('Nice read', $article->name);
    }

    public function testCheckIfEntityIsDeleted()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/DeleteArticleRequest.json'), true);

        $this->call('DELETE', '/entity-sync', $data);

        $article = Article::find(2);

        $this->assertNull($article);
    }

    public function testCheckIfEntityIsForceDeleted()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/ForceDeletePageRequest.json'), true);

        $this->call('DELETE', '/entity-sync', $data);

        $page = Page::withTrashed()->find(2);

        $this->assertNull($page);
    }

    public function testCheckIfEntityIsSoftDeleted()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/DeletePageRequest.json'), true);

        $this->call('DELETE', '/entity-sync', $data);

        $page = Page::withTrashed()->find(2);

        $this->assertTrue($page->trashed());
    }
}

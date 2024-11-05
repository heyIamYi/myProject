<?php

namespace Tests\Unit;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $postRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepositoryMock = Mockery::mock(PostRepositoryInterface::class);
        $this->app->instance(PostRepositoryInterface::class, $this->postRepositoryMock);
    }

    public function testIndex()
    {
        $posts = [
            ['id' => 1, 'title' => 'Test Title 1', 'content' => 'Test Content 1'],
            ['id' => 2, 'title' => 'Test Title 2', 'content' => 'Test Content 2'],
        ];

        // 設定預期的行為，當調用 all() 時回傳 $posts
        $this->postRepositoryMock->shouldReceive('all')->once()->andReturn($posts);

        // 呼叫 API，檢查回應
        $response = $this->getJson('api/posts');

        // 確認狀態碼和回傳的 JSON 資料是否正確
        $response->assertStatus(200)->assertJson($posts);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

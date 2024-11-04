<?php
namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return response()->json($this->postRepository->all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = $this->postRepository->create($data);

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = $this->postRepository->update($id, $data);
        return response()->json($post);
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return response()->json(null, 204);
    }
}

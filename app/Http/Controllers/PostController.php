<?php

    namespace App\Http\Controllers;



    use App\Http\Requests\PostRequest;
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;


    class PostController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $posts = Post::all();

            return view('posts.index', [
                'posts' => $posts,
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            return view('posts.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param PostRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(PostRequest $request)
        {
            $post = new Post();
            $post->title = $request->title;
            $post->text = $request->text;

            if (!empty($request->published)) {
                $post->published = $request->published;
            }

            $post->save();

            return redirect()->route('post.edit', [
                'post' => $post->id,
            ]);
        }

        /**
         * Display the specified resource.
         *
         * @param Post $post
         * @return Response
         */
        public function show(Post $post)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Post $post
         * @return Response
         */
        public function edit(Post $post)
        {
            return view('posts.edit', [
                'post' => $post
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param PostRequest $request
         * @param Post $post
         * @return Response
         */
        public function update(PostRequest $request, Post $post)
        {
            $post->title = $request->title;
            $post->text = $request->text;

            if (isset($request->published)) {
                $post->published = $request->published;
            }

            $post->save();
            return redirect()->route('post.edit', [
                'post' => $post->id,
            ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param Post $post
         * @return Response
         */
        public function destroy(Post $post)
        {
            $post->delete();
            return redirect()->route('post.index');
        }
    }

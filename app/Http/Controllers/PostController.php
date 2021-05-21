<?php

    namespace App\Http\Controllers;



    use App\Http\Requests\PostRequest;
    use App\Models\Post;
    use Illuminate\Http\Response;
    use Spatie\Permission\Exceptions\UnauthorizedException;


    class PostController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            if (!auth()->user()->hasPermissionTo('Consult')) {
                throw new UnauthorizedException('403', 'Custom Message');
            }
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
            if (!auth()->user()->hasPermissionTo('Register')) {
                throw new UnauthorizedException('403','Custom Message');
            }

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
            if (!auth()->user()->hasPermissionTo('Register')) {
                throw new UnauthorizedException('403','Custom Message');
            }

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
            if (!auth()->user()->hasPermissionTo('Edit')) {
                throw new UnauthorizedException('403', 'Custom Message');
            }
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
            if (!auth()->user()->hasPermissionTo('Edit')) {
                throw new UnauthorizedException('403', 'Custom Message');
            }
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
            if (!auth()->user()->hasPermissionTo('Delete')) {
                throw new UnauthorizedException('403', 'Custom Message');
            }
            $post->delete();
            return redirect()->route('post.index');
        }
    }

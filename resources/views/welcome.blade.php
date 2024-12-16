<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Content Generation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .show-content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .show-content h3 {
            color: #007bff;
        }
        .show-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .show-content ul {
            margin-left: 20px;
        }
        .show-content li {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2 class="text-center mt-4">Content Generate</h2>
            </div>
            <div class="card-body">
                <form id="contentForm" action="{{ route('gemini.content') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="prompt" class="form-label">Prompt</label>
                        <input type="text" class="form-control" name="prompt" id="prompt" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <div class="show-content mt-5">
                    {!! $game->description ?? null !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

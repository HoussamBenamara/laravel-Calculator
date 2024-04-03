<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('img/logo.png')}}"
                                alt="Logo" style="height: 130px;">
                            <h1 class="ms-2 mb-0">Calculator</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="calculator-form" action="/calculate" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="num1" class="form-label">Number 1</label>
                                <input type="number" class="form-control" id="num1" name="num1" required>
                            </div>
                            <div class="mb-3">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary operator"
                                        data-operator="+">+</button>
                                    <button type="button" class="btn btn-secondary operator"
                                        data-operator="-">-</button>
                                    <button type="button" class="btn btn-secondary operator"
                                        data-operator="*">&times;</button>
                                    <button type="button" class="btn btn-secondary operator"
                                        data-operator="/">÷</button>
                                </div>
                                <input type="hidden" id="operator" name="operator" required>
                            </div>
                            <div class="mb-3">
                                <label for="num2" class="form-label">Number 2</label>
                                <input type="number" class="form-control" id="num2" name="num2" required>
                            </div>
                            <button type="button" id="calculate-btn" class="btn btn-primary">Calculate</button>
                        </form>
                        <div id="result" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.operator').forEach((btn) => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.operator').forEach((op) => {
                    op.classList.remove('btn-primary');
                    op.classList.add('btn-secondary');
                });
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-primary');
                document.getElementById('operator').value = btn.dataset.operator;
            });
        });

        document.getElementById('calculate-btn').addEventListener('click', () => {
            const operator = document.getElementById('operator').value;

            if (!operator) {
                alert('Please select an operation');
                return;
            }

            const form = document.getElementById('calculator-form');
            const formData = new FormData(form);

            fetch('{{ route('calculate') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.hasOwnProperty('result')) {
                        document.getElementById('result').innerHTML = `<h5>Result:</h5><p>${data.result}</p>`;
                    } else {
                        document.getElementById('result').innerHTML =
                            '<div class="alert alert-danger">Error: Invalid calculation</div>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>

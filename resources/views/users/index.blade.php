<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchilar Ro‘yxati</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">


    <style>
        .three-btn{
            
            display: flex;
            gap: 5px; /* Tugmalar orasidagi masofa */
        }

            .three-btn form {
                display: inline-block;
            }

    </style>
</head>
<body>

    <x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Foydalanuvchilar Ro‘yxati</h2>
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif


        <script>
            document.addEventListener('DOMContentLoaded', function () {
            let alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000); // 3000 ms = 3 soniya
            }
        });
        </script>

        <table class="table table-bordered table-striped mx-auto" style="width: 80%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ism</th>
                    <th>Email</th>
                    <th>Ro‘yxatdan o‘tgan vaqt</th>
                    <th>Amallar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td> <!-- Ro‘yxatdan o‘tgan vaqt -->
                        <td>

                        <div class="three-btn ">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Haqiqatan ham o‘chirishni xohlaysizmi?')">
                                    O'chirish
                                </button>
                            </form>

                            <form action="{{ route('users.block', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Foydalanuvchini bloklamoqchimisiz?')">
                                    Bloklash
                                </button>
                            </form>
                        
                            <!-- Blokdan chiqarish -->
                            <form action="{{ route('users.unblock', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Foydalanuvchini blokdan chiqarmoqchimisiz?')">
                                    Blokdan chiqarish
                                </button>
                            </form>
                        </div>
                                
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>

    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.classList.add('fade-out');
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</x-app-layout>
</html>

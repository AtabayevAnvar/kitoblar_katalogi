<x-app-layout>

    <div class="card">
    @foreach($books as $book)
    <div class="card-in">
        <img src="{{ asset('storage/' . $book->img_url ) }}" alt="Kitob rasmi" class="book-image">
        <div class="content">
            <div class="info-row">
                <h2>Kitob nomi:</h2>
                <p>{{ $book->name }}</p>
            </div>

            <div class="info-row">
                <h2>Kitob muallifi:</h2>
                <p>{{ $book->author }}</p>
            </div>

            <div class="info-row">
                <h2>Kitob janri:</h2>
                <p>{{ $book->genre }}</p>
            </div>

            <div class="info-row">
                <h2>Yili:</h2>
                <p>{{ $book->year }}</p>
            </div>

            <div class="rating">
                <div class="rating-star" id="{{ $book->id }}" style="display:flex;">
                    @if($user)
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="checkbox" id="star{{ $i }}-{{ $book->id }}" data-star="{{ $i }}" 
                                @if($book->user_rating && $book->user_rating >= $i) checked @endif 
                                onclick="warning({{ $book->id }}, {{ $i }})" />
                            <label for="star{{ $i }}-{{ $book->id }}" class="star" 
                                style="color: @if($book->user_rating && $book->user_rating >= $i) gold @else gray @endif;">★</label>
                        @endfor
                        <label class="rating-ball" id="rating-value-{{ $book->id }}" style="display:none;">0</label>
                    @else
                    <!-- Mehmon foydalanuvchi uchun-->            
                        <a href="{{ route('login')}}" >
                            <div class="rating-star" style="display: flex">
                                
                                <label for="star1" class="star">★</label>
                                <label for="star2" class="star">★</label>
                                <label for="star3" class="star">★</label>
                                <label for="star4" class="star">★</label>
                                <label for="star5" class="star">★</label>
                            </div>
                        </a>
                        
                    @endif 
                                   
                </div>


                <label class="rating-ball" id="rating-value"> {{ number_format($book->rate, 1) }} </label>


                <button class="view-button">
                    <a href="{{ asset('storage/' . $book->book_url) }}">Kitobni ko'rish</a>
                </button>
            </div>
        </div>
    </div>
@endforeach
    </div>


    <script>
        function warning(id, i) {
            const question = `${i} yuldiz bermoqchimisiz?`;
            const result = confirm(question);

            if (result) {
                // Send the rating to the backend using Fetch
                fetch("{{ route('rate') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            num: i, // Send the star rating number
                            id: id, // Send the book ID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        
                        console.log(data.message);
                        window.location.reload();
                        // Handle success message from the backend
                    })
                    .catch(error => {
                        console.error('Error:', error); // Handle any errors
                    });
            } else {
                alert('Rating cancelled');
                // Optionally, reset the stars if the user cancels
            }
        }
    </script>


</x-app-layout>
<!-- </body>
</html>  -->
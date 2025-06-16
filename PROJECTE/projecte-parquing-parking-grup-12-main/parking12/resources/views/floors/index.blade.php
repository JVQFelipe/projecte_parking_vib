<div>
    <div>
        <div>
            <div>
                <div>
                    @if (session('success'))
                        {{ session('success') }}
                    @endif

                    @if (session('error'))
                        {{ session('error') }}
                    @endif
                </div> 
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Capacitat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($floors as $floor)
                            <tr>
                                <td>{{ $floor->id }}</td>
                                <td>{{ $floor->name }}</td>
                                <td>{{ $floor->latitude }}</td>
                                <td>{{ $floor->longitude }}</td>
                                <td>{{ $floor->capacity }}</td>
                                <td>
                                    <a href="{{ route('floors.show', $floor->id) }}">Mostrar</a> |
                                    <a href="/floors/update/{{ $floor->id }}">Editar</a> |
                                    <a href="/floors/destroy/{{ $floor->id }}">Esborrar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $floors->links() }}
                </div>

                <br>

                <form action="{{ route('floors.index') }}" method="GET">
                    <label for="page">Anar a pàgina:</label>
                    <input type="number" id="page" name="page" min="1" placeholder="1">
                    <button type="submit">Anar</button>
                </form>

                <br><br>

                <button id="alertButton">Fes clic aquí</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('alertButton').addEventListener('click', function() {
    alert('Has fet clic en el botó!');
});
</script>
@endpush

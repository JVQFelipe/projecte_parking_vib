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

                <a href="{{ route('parkings.create') }}">Afegir</a><br><br>

                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Tipus</th>
                            <th>Estat</th>
                            <th>Matricula</th>
                            <th>x1</th>
                            <th>y1</th>
                            <th>x2</th>
                            <th>y2</th>
                            <th>y2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parkingslots as $parkingslot)
                            <tr>
                                <td>{{ $parkingslot->id }}</td>
                                <td>{{ $parkingslot->name }}</td>
                                <td>{{ $parkingslot->slotType }}</td>
                                <td>{{ $parkingslot->slotStatus }}</td>
                                <td>{{ $parkingslot->plate }}</td>
                                <td>{{ $parkingslot->x1 }}</td>
                                <td>{{ $parkingslot->y1 }}</td>
                                <td>{{ $parkingslot->x2 }}</td>
                                <td>{{ $parkingslot->y2 }}</td>
                                <td>
                                    <a href="/parkingslots/show/{{ $parkingslot->id }}">Mostrar</a> |
                                    <a href="/parkingslots/update/{{ $parkingslot->id }}">Editar</a> |
                                    <a href="/parkingslots/destroy/{{ $parkingslot->id }}">Esborrar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $parkingslots->links() }}
                </div>

                <br>

                <form action="{{ route('parkingslots.index') }}" method="GET">
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

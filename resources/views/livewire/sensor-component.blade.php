<div>
    <div class="app">
        <h1>EnviroScan</h1>
    </div>
    <div class="container">
        <div class="card">
            <div class="title">
                <h2>Temperature :</h2>
            </div>
            <div class="card-content">
                <span class="score" wire:poll.1000ms>{{ $temperature }}</span>
                <span class="unit">°C</span>
            </div>
        </div>
        <div class="card">
            <div class="title">
                <h2>Humidity :</h2>
            </div>
            <div class="card-content">
                <span class="score" wire:poll.1000ms>{{ $humidity }}</span>
                <span class="unit">%</span>
            </div>
        </div>
    </div>
</div>

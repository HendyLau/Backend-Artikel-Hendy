<div>
   
 <div class="flex justify-between items-center mb-4">
         <h2 class="text-2xl font-bold mb-6">{{ __('Dashboard') }}</h2>           

        
    </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <!-- Posts -->
            <div class="bg-blue-600 text-white shadow rounded-2xl p-6">
                <div class="text-sm opacity-80">{{ __('Posts Count') }}</div>
                <div class="text-3xl font-bold mt-2">{{ $postCount }}</div>
            </div>
<br>
 <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <!-- Posts -->
            <div class="bg-blue-600 text-white shadow rounded-2xl p-6">
                <div class="text-sm opacity-80">{{ __('Video Count') }}</div>
                <div class="text-3xl font-bold mt-2">{{ $videoCount }}</div>
            </div>
<br>
            <!-- Pages -->
            <div class="bg-blue-600 text-white shadow rounded-2xl p-6">
                <div class="text-sm opacity-80">{{ __('Pages Count') }}</div>
                <div class="text-3xl font-bold mt-2">{{ $pageCount }}</div>
            </div>
<br>
            <!-- Categories -->
            <div class="bg-blue-600 text-white shadow rounded-2xl p-6">
                <div class="text-sm opacity-80">{{ __('Categories Count') }}</div>
                <div class="text-3xl font-bold mt-2">{{ $categoryCount }}</div>
            </div>
        </div>

       <!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Line Chart: Posts per Month -->
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-semibold mb-2">{{ __('Posts per Month') }}</h3>
        <canvas id="postsPerMonthChart"></canvas>
    </div>

    <!-- Pie Chart: Post Status -->
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-semibold mb-2">{{ __('Post Status') }}</h3>
        <canvas id="postStatusChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Line chart
        const ctx1 = document.getElementById('postsPerMonthChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyPosts->keys()) !!},
                datasets: [{
                    label: '{{ __("Posts") }}',
                    data: {!! json_encode($monthlyPosts->values()) !!},
                    borderColor: 'rgba(59,130,246,1)',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Pie chart
        const ctx2 = document.getElementById('postStatusChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: {!! json_encode($statusBreakdown->keys()) !!},
                datasets: [{
                    data: {!! json_encode($statusBreakdown->values()) !!},
                    backgroundColor: ['#3b82f6', '#f59e0b']
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>

    
</div>


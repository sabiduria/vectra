<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Business Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://d3js.org/d3.v7.min.js"></script>
  <style>
    .dashboard { padding: 20px; display: grid; gap: 20px; }
    .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    canvas { max-height: 400px; }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Revenue Growth Card -->
    <div class="card">
      <h3>Revenue Growth (%)</h3>
      <canvas id="revenueChart"></canvas>
    </div>

    <!-- Inventory Valuation Card -->
    <div class="card">
      <h3>Top 10 Inventory Valuation</h3>
      <div id="inventoryChart"></div>
    </div>
  </div>

  <script>
    // Fetch Revenue Growth Data
    fetch('api/revenue.php')
      .then(res => res.json())
      .then(data => {
        new Chart(document.getElementById('revenueChart'), {
          type: 'line',
          data: {
            labels: data.map(row => row.month),
            datasets: [{
              label: 'Monthly Growth Rate (%)',
              data: data.map(row => row.growth_rate),
              borderColor: '#4CAF50',
              tension: 0.3
            }]
          }
        });
      });

    // Fetch Inventory Data (D3.js Bar Chart)
    fetch('api/inventory.php')
      .then(res => res.json())
      .then(data => {
        const margin = { top: 20, right: 30, bottom: 40, left: 90 },
              width = 800 - margin.left - margin.right,
              height = 400 - margin.top - margin.bottom;

        const svg = d3.select("#inventoryChart")
          .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
          .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        // X axis
        const x = d3.scaleLinear()
          .domain([0, d3.max(data, d => d.total_value)])
          .range([0, width]);

        // Y axis
        const y = d3.scaleBand()
          .domain(data.map(d => d.name))
          .range([0, height])
          .padding(0.1);

        // Bars
        svg.selectAll("rect")
          .data(data)
          .enter()
          .append("rect")
            .attr("x", 0)
            .attr("y", d => y(d.name))
            .attr("width", d => x(d.total_value))
            .attr("height", y.bandwidth())
            .attr("fill", "#2196F3");

        // Add axes
        svg.append("g")
          .attr("transform", `translate(0,${height})`)
          .call(d3.axisBottom(x));

        svg.append("g")
          .call(d3.axisLeft(y));
      });
  </script>
</body>
</html>
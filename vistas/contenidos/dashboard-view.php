<script type="text/javascript">
    window.setInterval(function () {
        updateStats();
    }, 2000);

    function updateStats() {
        updateConnectedUsers();
        updateDailyRevenue();
    }

    function updateConnectedUsers() {
        jQuery.get(
            'get_connected_users.php',
            function (data) {
                $('#connected_users').text(data);
            }
        );
    }

    function updateDailyRevenue() {
        jQuery.get(
            'get_daily_revenue.php',
            function (data) {
                $('#daily_revenue').text(data);
            }
        );
    }
</script>
			
			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES
				</h3>
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
				</p>
			</div>

			<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    Usuarios conectados en este momento: <strong><span id="connected_users">0</span></strong>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    Facturación del día: <strong>$ <span id="daily_revenue">0.00</span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
		
		
			</div>
			</div>
		</div>
		</section>



		<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
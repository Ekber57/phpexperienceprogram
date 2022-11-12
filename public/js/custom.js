$(document).ready(function () {


	$State = {
		Listeners: [],
		LadingOfLists: 0,
		LadingOfPayments: 0,
		notifyListLoading: function () {
			this.LadingOfLists = 1
			this.run()
			// alert("list created")
		},
		notifyPaymentsLoading: function () {
			this.LadingOfPayments = 1
			this.run()
		},
		addListener: function (callback) {
			this.Listeners.push(callback)
			alert("paymnets created")

		},

		run: function () {
			console.log(this.Listensers)
			if (this.LadingOfPayments && this.LadingOfPayments == 1) {
				this.Listeners.forEach(function (calback) {
					calback()

				})
			}

		}
	}



	$("#mamount").on("input", function () {
		$amount = $(this).val().toString()
		const pattern = /^[0-9]*$/;
		if ($amount.length == 0) {
			$("#smamount").text("0.00")
		} else if (pattern.test($amount)) {
			$("#smamount").text($amount.concat(".00"))

		} else if (/^[0-9]*[.][0-9]{2}$/.test($amount)) {
			$("#smamount").text($amount)

		} else if (/^[0-9]*[.][0-9]{1}$/.test($amount)) {
			$("#smamount").text($amount.concat("0"))
		}



	})























	$("#filteremitter").on("click", function (e) {
        e.preventDefault()
		// $("#modalforpayment").modal("show")
		getFilteredPayments()

	})

	$("#modalemitter").on("click", function () {
		$("#modalforpayment").modal("show")
	})

	$("#payemitter").on("click", function () {
		addPayment()
	})


	getPayments()

	function getFilteredPayments() {
		$tbody = $("#tbodygeneral").empty()
		$dateFrom = $("#datefrom").val()
		$dateTo = $("#dateto").val()
		$currencyId = $("#currency").val()
		$userId = $("#userlist").val()
		$currencyId = $("#currencylist").val()
		data = {
				user: $userId,
				currency: $currencyId,
				datefrom: $dateFrom,
				dateto: $dateTo,
			},

			console.log(data)
		$.ajax({
			url: "http://localhost/payment/getall",
			contentType: "application/json",
			// ; charset=utf-8"},
			dataType: 'json',
			type: "POST",
			error: function (e) {

			},
			data: JSON.stringify(data),

			success: function (data) {
				// removeLoader(
				// =
				// console.log(data)
				// document.write(data.responseText)
				// return 0
				$(data).each(function (i, e) {

					$tr = $("<tr>")
					$tdSS = $("<td>", {
						scope: "row",
						text: ++i
					})
					$tdUser = $("<td>", {
						text: e.user
					})
					$tdMedaxil = $("<td>", {
						text: (e.medaxil != 0.00) ? e.medaxil.concat(" ", e.currency) : "-"
					})
					$tdMexaric = $("<td>", {
						text: (e.mexaric != 0.00) ? e.mexaric.concat(" ", e.currency) : "-"
					})
					$tdDate = $("<td>", {
						text: e.date
					})
					$tbody.append($tr)
					$tbody.append($tdSS)
					$tbody.append($tdUser)
					$tbody.append($tdMedaxil)
					$tbody.append($tdMexaric)
					$tbody.append($tdDate)





				});
				$tbody.append($tbody)
				// $State.LadingOfPayments = 1

			},
			error: function (e) {
				// console.log(e)
			}


		})

	}


	function getPayments() {
		$tbody = $("#tbodygeneral").empty()
		$dateFrom = $("#datefrom").val()
		$dateTo = $("#dateto").val()
		$currencyId = $("#currency").val()
		$userId = $("#userlist").val()
		$currencyId = $("#currencylist").val()
		$.ajax({
			url: "http://localhost/payment/getall",
			dataType: 'JSON',
			type: "POST",
			success: function (data) {
				// removeLoader(
				$A = data

				$(data).each(function (i, e) {

					$tr = $("<tr>")
					$tdSS = $("<td>", {
						scope: "row",
						text: ++i
					})
					$tdUser = $("<td>", {
						text: e.user
					})
					$tdMedaxil = $("<td>", {
						text: (e.medaxil != 0.00) ? e.medaxil.concat(" ", e.currency) : "-"
					})
					$tdMexaric = $("<td>", {
						text: (e.mexaric != 0.00) ? e.mexaric.concat(" ", e.currency) : "-"
					})
					$tdDate = $("<td>", {
						text: e.date
					})
					$tbody.append($tr)
					$tbody.append($tdSS)
					$tbody.append($tdUser)
					$tbody.append($tdMedaxil)
					$tbody.append($tdMexaric)
					$tbody.append($tdDate)





				});
				$tbody.append($tbody)
				// $State.LadingOfPayments = 1

			}

		})

	}




	function addPayment() {
		$data = {
			user: $("#muserlist").val(),
			amount: $("#mamount").val(),
			currency: $("#mcurrencylist").val(),
			payment_type: $("#paymentcategorylist").val(),
		}
		console.log($data)
		$.ajax({
			url: "http://localhost/payment/add",
			dataType: 'JSON',
			type: "POST",
			data: $data,
			success: function (data) {
				$("#mamount").val("0.00")
				$("#smamount").text("0.00")
			}

		})
	}











	function getPaymentStatics() {
		$tbody = $("#tbodystatics").empty()
		$dateFrom = $("#datefrom").val()
		$dateTo = $("#dateto").val()
		$currencyId = $("#currency").val()
		$userId = $("#userlist").val()
		$currencyId = $("#currencylist").val()
		$.ajax({
			url: "http://localhost/payment/getpaymentstatics",
			dataType: 'JSON',
			type: "POST",
			success: function (data) {
				// removeLoader(
				$A = data

				$(data).each(function (i, e) {

					$tr = $("<tr>")
					$tdSS = $("<td>", {
						scope: "row",
						text: ++i
					})
					$tdUser = $("<td>", {
						text: e.user
					})
					$tdMedaxil = $("<td>", {
						text: (e.medaxil != 0.00) ? e.medaxil.concat(" ", e.currency) : "-"
					})
					$tdMexaric = $("<td>", {
						text: (e.mexaric != 0.00) ? e.mexaric.concat(" ", e.currency) : "-"
					})
					$tdDate = $("<td>", {
						text: (e.qaliq != 0.00) ? e.qaliq.toString().concat(" ", e.currency) : "-"
					})
					$tbody.append($tr)
					$tbody.append($tdSS)
					$tbody.append($tdUser)
					$tbody.append($tdMedaxil)
					$tbody.append($tdMexaric)
					$tbody.append($tdDate)





				});
				$tbody.append($tbody)
				// $State.LadingOfPayments = 1

			}

		})

	}




	getPaymentStatics()











































	function CreateUserListComponent(target, data) {
		$el = $(`#${target}`)
		$(data).each((i, e) => {
			$el.append($("<option>", {
				"value": e.id,
				"text": e.name
			}))
		})
	}

	function getMainDatas() {

		$.ajax({
			url: "http://localhost/payment",
			dataType: 'JSON',
			type: "GET",
			success: function (data) {
				CreateUserListComponent("userlist", data.users)
				CreateUserListComponent("currencylist", data.currencies)
				CreateUserListComponent("payment_categories", data.payment_categories)
				$("#userlist").clone().first().appendTo("#modaluserlist").attr("id", "muserlist");
				$("#currencylist").clone().appendTo("#modalcurrencylist").attr("id", "mcurrencylist");
				CreateUserListComponent("paymentcategorylist", data.payment_categories)
				$("#muserlist option").eq(0).remove()
				$("#mcurrencylist option").eq(0).remove()

			}
		})

	}


	getMainDatas()














})

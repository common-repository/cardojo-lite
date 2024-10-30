(function( $ ) {
    'use strict';

    jQuery.fn.exists = function(){return this.length>0;}

    if( jQuery("#deal_purchase_price").exists() ) {

        jQuery("#deal_purchase_price").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_trade_in_payoff").exists() ) {

        jQuery("#deal_trade_in_payoff").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_trade_in_allowance").exists() ) {

        jQuery("#deal_trade_in_allowance").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_down_payment").exists() ) {

        jQuery("#deal_down_payment").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_sales_tax").exists() ) {

        jQuery("#deal_sales_tax").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_sales_tax_fee").exists() ) {

        jQuery("#deal_sales_tax_fee").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_interest_rate").exists() ) {

        jQuery("#deal_interest_rate").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_loan_term").exists() ) {

        jQuery("#deal_loan_term").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_loan_term_priod").exists() ) {

        jQuery("#deal_loan_term_priod").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_loan_payment_amount_period").exists() ) {

        jQuery("#deal_loan_payment_amount_period").change(function() {
            refreshTransactionInfo();
        });

    }

    if( jQuery("#deal_vehicle_id").exists() ) {

        jQuery('#deal_vehicle_id').change(function(){
            var selected = $(this).find('option:selected');
            var price = selected.data('clean-price');
            jQuery("#deal_purchase_price").val(price);
            setTimeout(function functionName() {
                refreshTransactionInfo();
            }, 200);
        });

    }

    function refreshTransactionInfo() {

        var purchaseAmt = 0.00;
        var purchaseAmtText = document.getElementById('deal_purchase_price').value;
        if (purchaseAmtText.length > 0) {
            purchaseAmt = Number(purchaseAmtText);
        }
        else {
            document.getElementById('deal_purchase_price').value = "0.00";
        }

        var totalTaxes = 0.00;
        var totalTaxesText = document.getElementById('deal_sales_tax').value;
        if (totalTaxesText.length > 0) {
            totalTaxes = purchaseAmt * (Number(totalTaxesText) / 100);
        }
        else {
            document.getElementById('deal_sales_tax').value = "0.00";
        }

        var totalTaxesFeeText = document.getElementById('deal_sales_tax_fee').value;
        if (totalTaxesFeeText.length > 0) {
            totalTaxes = Number(totalTaxes) + Number(totalTaxesFeeText);
        }
        else {
            document.getElementById('deal_sales_tax_fee').value = "0.00";
        }

        var cost = 0.00;
        var costText = document.getElementById('deal_purchase_cost').value;
        if (costText.length > 0) {
            cost = Number(costText);
        }
        else {
            document.getElementById('deal_purchase_cost').value = "0.00";
        }

        var downPayment = 0.00;
        var downPaymentText = document.getElementById('deal_down_payment').value;
        if (downPaymentText.length > 0) {
            downPayment = Number(downPaymentText);
        }
        else {
            document.getElementById('deal_down_payment').value = "0.00";
        }

        var tradePayoff = 0.00;
        var tradePayoffText = document.getElementById('deal_trade_in_payoff').value;
        if (tradePayoffText.length > 0) {
            tradePayoff = Number(tradePayoffText);
        }
        else {
            document.getElementById('deal_trade_in_payoff').value = "0.00";
        }

        var tradeAllowance = 0.00;
        var tradeAllowanceText = document.getElementById('deal_trade_in_allowance').value;
        if (tradeAllowanceText.length > 0) {
            tradeAllowance = Number(tradeAllowanceText);
        }
        else {
            document.getElementById('deal_trade_in_allowance').value = "0.00";
        }

        var subTotal = purchaseAmt + tradePayoff - tradeAllowance;
        var profit = purchaseAmt - cost;
        var totalDue = subTotal + totalTaxes - downPayment;

        document.getElementById('deal_total_price').value = subTotal.toFixed(2);
         if ('True' == 'True') {
            document.getElementById('deal_profit').value = profit.toFixed(2);
            document.getElementById('deal_profit_hidden').value = profit.toFixed(2);
        }
        document.getElementById('deal_total_balance_due').value = totalDue.toFixed(2);

        var loanAmt = 0.00;
        var loanAmtText = document.getElementById('deal_loan_amount');

        loanAmt = totalDue;
        loanAmtText.value = totalDue.toFixed(2);

        document.getElementById('deal_trade_in_payoff').value = tradePayoff.toFixed(2);
        document.getElementById('deal_trade_in_allowance').value = tradeAllowance.toFixed(2);

        var annualInterestRate = 10.0;
        var interestRateText = document.getElementById('deal_interest_rate');
        if (interestRateText.value.length > 0) {
            annualInterestRate = Number(interestRateText.value) / 100;
        }
        else {
            interestRateText.value = "10.0";
        }

        var monthRate = annualInterestRate / 12;
        var semiMonthlyRate = annualInterestRate / 24;
        var weeklyRate = annualInterestRate / 52;
        var biweeklyRate = annualInterestRate / 26;

        var numPayments = 0;
        var rate = 0;

        var termLengthText = document.getElementById('deal_loan_term');
        if (termLengthText.value.length == 0) {
            termLengthText.value = "5";
        }

        var termType = document.getElementById('deal_loan_term_priod');
        var paymentType = document.getElementById('deal_loan_payment_amount_period');
        if (termType.value == "Years") {
            document.getElementById('deal_loan_payments_period').value = "year";
            var years = Number(termLengthText.value);
            var finalDatePeriod = "+" + years + " year";
            if (paymentType.value == "Monthly") {
                rate = monthRate;
                numPayments = years * 12;
            }
            else if (paymentType.value == "Semi-Monthly") {
                rate = semiMonthlyRate;
                numPayments = years * 24;
            }
            else if (paymentType.value == "Weekly") {
                rate = weeklyRate;
                numPayments = years * 52;
            }
            else {
                rate = biweeklyRate;
                numPayments = years * 26;
            }
        }
        else if (termType.value == "Months") {
            document.getElementById('deal_loan_payments_period').value = "month";
            var months = Number(termLengthText.value);
            var finalDatePeriod = "+" + months + " month";
            if (paymentType.value == "Monthly") {
                rate = monthRate;
                numPayments = months;
            }
            else if (paymentType.value == "Semi-Monthly") {
                rate = semiMonthlyRate;
                numPayments = months * 2;
            }
            else if (paymentType.value == "Weekly") {
                rate = weeklyRate;
                numPayments = (months / 12) * 52;
            }
            else {
                rate = biweeklyRate;
                numPayments = (months / 12) * 26;
            }
        }
        else {
            document.getElementById('deal_loan_payments_period').value = "week";
            var weeks = Number(termLengthText.value);
            var finalDatePeriod = "+" + weeks + " week";
            if (paymentType.value == "Monthly") {
                rate = monthRate;
                numPayments = (weeks / 52) * 12;
            }
            else if (paymentType.value == "Semi-Monthly") {
                rate = semiMonthlyRate;
                numPayments = (weeks / 52) * 24;
            }
            else if (paymentType.value == "Weekly") {
                rate = weeklyRate;
                numPayments = weeks;
            }
            else {
                rate = biweeklyRate;
                numPayments = weeks / 2;
            }
        }

        document.getElementById('deal_loan_payments_num').value = numPayments;
        document.getElementById('deal_loan_final_date').value = finalDatePeriod;
        document.getElementById('deal_loan_rate').value = rate;

        var payment = 0;
        if (rate != 0) {
            payment = Math.floor( (loanAmt * rate) / (1 - Math.pow((1 + rate), (-1 * numPayments)) ) * 1000) / 1000;
        }
        else {
            payment = loanAmt / numPayments;
        }

        document.getElementById('deal_loan_payment_amount_x').value = Number(payment.toFixed(2));
        document.getElementById('deal_loan_payment_amount').value = payment.toFixed(2);
        
    }

    refreshTransactionInfo();

    if( jQuery(".deal_loan_payments_rate").exists() ) {

        jQuery(".deal_loan_payments_rate").change(function() {

            var this_id = $(this).data('id');

            var newRate = Number(document.getElementById('deal_loan_rate').value);

            var numPayments = document.getElementById('deal_loan_payments_num').value;
            var newNumPayments = numPayments - this_id;

            var newPaymentAmount = document.getElementById('deal_loan_payments_'+this_id).value;
            var deal_loan_rate = document.getElementById('deal_loan_rate').value;
            if(this_id > 1) {
                var deal_purchase_price = document.getElementById('deal_loan_payments_balance_'+(this_id-1)).value;
            } else {
                var deal_purchase_price = document.getElementById('deal_loan_payments_balance_'+(this_id)).value;
            }

            var loan_interest = deal_purchase_price * deal_loan_rate;
            var loan_principal = newPaymentAmount - loan_interest;
            var newLoanAmt = deal_purchase_price - loan_principal;

            document.getElementById('deal_loan_payments_principal_'+this_id).value = loan_principal.toFixed(2);
            document.getElementById('deal_loan_payments_balance_'+this_id).value = newLoanAmt.toFixed(2);

            refreshNewTransactionInfo( newNumPayments, numPayments, newLoanAmt, newRate, this_id );

        });

    }

    function refreshNewTransactionInfo( newNumPayments, numPayments, newLoanAmt, newRate, this_id ) {

        var new_payment = 0;

        if (newRate != 0) {
            new_payment = Math.floor( (newLoanAmt * newRate) / (1 - Math.pow((1 + newRate), (-1 * newNumPayments)) ) * 1000) / 1000;
        }
        else {
            new_payment = newLoanAmt / newNumPayments;
        }

        var newPaymentAmount = new_payment;
        var deal_loan_rate = 0;
        var deal_purchase_price = newLoanAmt;

        var loan_interest = 0;
        var loan_principal = 0;
        var total_interest = 0;
        var old_interest = 0;

        deal_loan_rate = document.getElementById('deal_loan_rate').value;
        old_interest = Number(document.getElementById('deal_loan_payments_total_interest_'+this_id).value);

        var i = 0;

        for ( i = (this_id + 1); i <= numPayments; i++ ) {

            loan_interest = deal_purchase_price * deal_loan_rate;
            loan_principal = newPaymentAmount - loan_interest;
            newLoanAmt = deal_purchase_price - loan_principal;
            deal_purchase_price = newLoanAmt;

            total_interest = old_interest + loan_interest;
            old_interest = total_interest;

            if( numPayments == i ) {
                newLoanAmt = 0;
            }

            document.getElementById('deal_loan_payments_'+i).value = new_payment.toFixed(2);
            document.getElementById('deal_loan_payments_principal_'+i).value = loan_principal.toFixed(2);
            document.getElementById('deal_loan_payments_interest_'+i).value = loan_interest.toFixed(2);
            document.getElementById('deal_loan_payments_total_interest_'+i).value = total_interest.toFixed(2);
            document.getElementById('deal_loan_payments_balance_'+i).value = newLoanAmt.toFixed(2);



        }

    }

})( jQuery );

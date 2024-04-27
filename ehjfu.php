<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontendRateCalculator extends Controller
{
    public function rate_calculator(Request $request)
    {
        $request->validate([
            'shipping_category' => 'required',
            'delivery_mode' => 'required',
            'delivery_type' => 'required',
            'product_category' => 'required',
            'order_cat' => 'required',
        ]);

        if ($request->shipping_category == 'B2C' && $request->delivery_mode == 'Surface') {

            $product_weight = (int) $request->weight;

            // Local Delivery...
            if ($request->order_cat == "Local Delivery (Same Pin)") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_local')
                    ->get();
                $find_rate = $query[0]->rate_for_local;
                if ($product_weight <= 500) {
                    $rate = $query[0]->rate_for_local;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_local);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_local);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_local);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Same District Delivery...
            if ($request->order_cat == "Same District Delivery") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_same_district')
                    ->get();
                $find_rate = $query[0]->rate_for_same_district;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_same_district);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_same_district);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_same_district);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Within 200 km Delivery...
            if ($request->order_cat == 'Different District Delivery (Within 200km)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_below_200km')
                    ->get();
                $find_rate = $query[0]->rate_for_below_200km;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_below_200km);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_below_200km);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_below_200km);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Rest of State Delivery...
            if ($request->order_cat ==  'Different District Delivery (West Bengal)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_rest_of_state')
                    ->get();
                $find_rate = $query[0]->rate_for_rest_of_state;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_state);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_state);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_rest_of_state);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Metro City Delivery...
            if ($request->order_cat == 'Delivery To Metro City') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_metro_city')
                    ->get();
                $find_rate = $query[0]->rate_for_metro_city;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_metro_city);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_metro_city);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_metro_city);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Rest of India Delivery...
            if ($request->order_cat == 'Rest Of India Delivery') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_rest_of_india')
                    ->get();
                $find_rate = $query[0]->rate_for_rest_of_india;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_india;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_india;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_india);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_india;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_india);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'surface')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_india')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_rest_of_india);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }
        }

        if ($request->shipping_category == 'B2C' && $request->delivery_mode == 'Express') {

            $product_weight = (int) $request->weight;

            // Local Delivery...
            if ($request->order_cat == "Local Delivery (Same Pin)") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'express')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_local')
                    ->get();
                $find_rate = $query[0]->rate_for_local;
                if ($product_weight <= 500) {
                    $rate = $query[0]->rate_for_local;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_local);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_local;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_local);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_local')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_local);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Same District Delivery...
            if ($request->order_cat == "Same District Delivery") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'express')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_same_district')
                    ->get();
                $find_rate = $query[0]->rate_for_same_district;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_same_district);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_same_district;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_same_district);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_same_district')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_same_district);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Within 200 km Delivery...
            if ($request->order_cat == 'Different District Delivery (Within 200km)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'express')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_below_200km')
                    ->get();
                $find_rate = $query[0]->rate_for_below_200km;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_below_200km);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_below_200km;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_below_200km);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_below_200km')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_below_200km);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Rest of State Delivery...
            if ($request->order_cat ==  'Different District Delivery (West Bengal)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'express')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_rest_of_state')
                    ->get();
                $find_rate = $query[0]->rate_for_rest_of_state;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_state);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_rest_of_state;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_rest_of_state);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_rest_of_state')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_rest_of_state);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Metro City Delivery...
            if ($request->order_cat == 'Rest Of India Delivery') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                    ->where('rate_chart_details.delivery_mode', '=', 'express')
                    ->where('rate_chart_details.shipping_category', '=', 'B2C')
                    ->select('rate_chart_details.rate_for_metro_city')
                    ->get();
                $find_rate = $query[0]->rate_for_metro_city;
                if ($product_weight <= 500) {
                    $rate = $find_rate;
                } else if ($product_weight > 500 && $product_weight <= 5000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $rate = $rate500 + (((int)(($product_weight - 500) / 501) + 1) * $find_rate);
                } else if ($product_weight > 5000 && $product_weight <= 10000) {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_metro_city);
                    $rate = $rate5000 + (((int)(($product_weight - 5000) / 1001) + 1) * $find_rate);
                } else {
                    $query_500 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 500)
                        ->where('upper_limit', '>', 250)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate500 = $query_500[0]->rate_for_metro_city;
                    $query_5000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 5000)
                        ->where('upper_limit', '>', 500)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate5000 = $rate500 + (9 * $query_5000[0]->rate_for_metro_city);
                    $query_10000 = DB::table('rate_chart_ranges')
                        ->where('lower_limit', '<=', 10000)
                        ->where('upper_limit', '>', 5000)
                        ->join('rate_chart_details', 'rate_chart_ranges.id', '=', 'rate_chart_details.range_id')
->where('rate_chart_details.rate_chart_menu_id', '=', 6)
                        ->where('rate_chart_details.delivery_mode', '=', 'express')
                        ->where('rate_chart_details.shipping_category', '=', 'B2C')
                        ->select('rate_chart_details.rate_for_metro_city')
                        ->get();
                    $rate10000 = $rate5000 + (5 * $query_10000[0]->rate_for_metro_city);
                    $rate = $rate10000 + (((int)(($product_weight - 10000) / 1001) + 1) * $find_rate);
                }

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }
        }

        if ($request->shipping_category == 'B2B' && $request->delivery_mode == 'Surface') {

            $product_weight = (int) $request->weight;

            // Same District Delivery...
            if ($request->order_cat == "Same District Delivery") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.rate_for_same_district')
                    ->get();
                $find_rate = $query[0]->rate_for_same_district;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Within 200 km Delivery...
            if ($request->order_cat == 'Different District Delivery (Within 200km)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.distance_less_200km')
                    ->get();
                $find_rate = $query[0]->distance_less_200km;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Rest of State Delivery...
            if ($request->order_cat == 'Rest Of India Delivery') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'surface')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.rate_for_rest_of_state')
                    ->get();
                $find_rate = $query[0]->rate_for_rest_of_state;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }
        }

        if ($request->shipping_category == 'B2B' && $request->delivery_mode == 'Express') {

            $product_weight = (int) $request->weight;

            // Same District Delivery...
            if ($request->order_cat == "Same District Delivery") {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'express')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.rate_for_same_district')
                    ->get();
                $find_rate = $query[0]->rate_for_same_district;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Within 200 km Delivery...
            if ($request->order_cat == 'Different District Delivery (Within 200km)') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'express')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.distance_less_200km')
                    ->get();
                $find_rate = $query[0]->distance_less_200km;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }

            // Rest of State Delivery...
            if ($request->order_cat == 'Rest Of India Delivery') {
                $query = DB::table('rate_chart_ranges')
                    ->where('lower_limit', '<=', $product_weight)
                    ->where('upper_limit', '>=', $product_weight)
                    ->join('rate_chart_details_b2b', 'rate_chart_ranges.id', '=', 'rate_chart_details_b2b.range_id')
                    ->where('rate_chart_details_b2b.delivery_mode', '=', 'express')
                    ->where('rate_chart_details_b2b.shipping_category', '=', 'B2B')
                    ->select('rate_chart_details_b2b.rate_for_rest_of_state')
                    ->get();
                $find_rate = $query[0]->rate_for_rest_of_state;
                $rate = ($product_weight / 1000) * $find_rate;

                return redirect()->back()->with('rate', $rate, 'delivery_type', $request->delivery_type, 'cod_amount', $request->cod_amount);
            }
        }

        return redirect()->back();
    }
}

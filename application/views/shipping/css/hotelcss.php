<style type="text/css">
	.tt-dropdown-menu{
		width: 100%;
	    margin-top: 7px;
	    background: #fff;
	    border: 1px solid #e6e6e6;
	    max-height: 300px;
	    overflow-y: auto;
	    white-space: nowrap;	
	}
	.tt-input, .tt-hint {
	  color: #999;
	}
	.tt-dropdown-menu {
	  width: 100%;
	  margin-top: 7px;
	  background: #fff;
	  border: 1px solid #e6e6e6;
	  max-height: 300px;
	  overflow-y: auto;
	  white-space: nowrap;
	}
	.tt-suggestion {
	  line-height: 1em;
	  padding: 15px 20px;
	  font-size: 13px;
	  border-bottom: 1px solid #e6e6e6;
	}
	.tt-suggestion p {
	  margin: 0;
	}
	.tt-suggestion.tt-cursor {
	  color: #fff;
	  background: #ed8323;
	  cursor: pointer;
	}

	.booking-list {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}
.booking-list > li {
  margin-bottom: 15px;
  position: relative;
}
.booking-item {
  /* cursor: pointer; */
  display: block;
  position: relative;
  padding: 17px;
  border: 1px solid #e6e6e6;
  color: #737373;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.view-more-prices{
  cursor: pointer;
}
.booking-item:hover,
.booking-item.active {
  color: #737373;
  border: 1px solid #ed8323;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.2);
  box-shadow: 0 2px 1px rgba(0,0,0,0.2);
}
.booking-item:hover .booking-item-number,
.booking-item.active .booking-item-number {
  background: #808080;
}
.booking-item:hover .booking-item-img-wrap .booking-item-img-num,
.booking-item.active .booking-item-img-wrap .booking-item-img-num {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  background: rgba(0,0,0,0.5);
}
.booking-item.booking-item-small {
  padding: 11px;
}
.booking-item.booking-item-small .booking-item-title {
  font-size: 14px;
  margin-bottom: 0;
}
.booking-item.booking-item-small .booking-item-rating-stars {
  font-size: 12px;
  margin-bottom: 0;
  color: #ed8323;
}
.booking-item.booking-item-small .booking-item-price {
  font-size: 20px;
  font-weight: 400;
  margin-bottom: 2px;
  display: inline;
}
.booking-item.booking-item-small .booking-item-price-from {
  font-size: 12px;
  margin-bottom: 2px;
}
.booking-item-title {
  margin-bottom: 7px;
}
.booking-item-description {
  font-size: 13px;
  line-height: 1.5em;
}
.booking-item-img-wrap {
  position: relative;
}
.booking-item-img-wrap .booking-item-img-num {
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  position: absolute;
  bottom: 0;
  right: 0;
  color: #fff;
  background: rgba(0,0,0,0.01);
  padding: 5px 7px;
  font-size: 13px;
  line-height: 1em;
}
.booking-item-img-wrap .booking-item-img-num > .fa {
  margin-right: 3px;
}
.booking-item-last-booked {
  font-size: 11px;
}
.booking-item-rating {
  margin-bottom: 3px;
  padding-bottom: 3px;
  border-bottom: 1px solid #f7f7f7;
  display: inline-block;
}
.booking-item-rating .booking-item-rating-stars {
  display: inline-block;
  margin-right: 17px;
  margin-bottom: -5px;
  color: #ed8323;
}
.booking-item-rating .booking-item-rating-stars .fa {
  margin-right: 0;
}
.booking-item-rating .booking-item-rating-number {
  margin-right: 7px;
}
.booking-item-rating .booking-item-rating-number > b {
  font-size: 25px;
}
.booking-item-address {
  line-height: 1em;
  font-size: 13px;
}
.booking-item-price-from {
  display: block;
  font-size: 12px;
  line-height: 1em;
}
.booking-item-price {
  font-size: 36px;
  color: #626262;
  line-height: 1em;
  display: inline-block;
  margin-bottom: 12px;
}
.booking-item-number {
  position: absolute;
  width: 20px;
  height: 20px;
  line-height: 20px;
  background: #e6e6e6;
  text-align: center;
  color: #fff;
  display: block;
  top: 2px;
  right: 2px;
  font-size: 10px;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-flight-details {
  overflow: hidden;
}
.booking-item-flight-details .booking-item-departure,
.booking-item-flight-details .booking-item-arrival {
  float: left;
  width: 47%;
}
.booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-flight-details .booking-item-arrival .fa-plane {
  float: left;
  display: block;
  font-size: 30px;
  margin-right: 5px;
  position: relative;
  top: 4px;
}
.booking-item-flight-details .booking-item-departure h5,
.booking-item-flight-details .booking-item-arrival h5 {
  margin-bottom: 0;
}
.booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-flight-details .booking-item-arrival .booking-item-date {
  margin-bottom: 7px;
  font-size: 12px;
  line-height: 1em;
  padding-left: 32px;
}
.booking-item-flight-details .booking-item-departure {
  margin-right: 6%;
}
.booking-item-flight-details .booking-item-destination {
  font-size: 12px;
  line-height: 1.3em;
}
.booking-item-airline-logo > p {
  margin-bottom: 0;
  font-size: 12px;
  margin-top: 5px;
  line-height: 1.3em;
}
.booking-item-airline-logo > img {
  width: 40px;
}
.booking-item-flight-class {
  margin-bottom: 7px;
  margin-top: -5px;
  font-size: 11px;
  color: #8f8f8f;
  line-height: 1em;
}
.booking-item-features {
  list-style: none;
  margin: 0;
  padding: 0;
}
.booking-item-features > li {
  float: left;
  position: relative;
  margin-right: 7px;
  margin-bottom: 7px;
}
.booking-item-features > li:hover > i {
  border-color: #d66f11;
}
.booking-item-features > li .booking-item-feature-sign {
  position: absolute;
  bottom: 2px;
  left: 0;
  display: block;
  text-align: center;
  font-size: 10px;
  line-height: 1em;
  width: 100%;
}
.booking-item-features > li > i {
  height: 35px;
  width: 35px;
  text-align: center;
  line-height: 35px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  font-size: 23px;
  display: block;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  color: #686868;
}
.booking-item-features-dark > li > i {
  background: #4d4d4d;
  border: 1px solid #333;
  color: #fff;
}
.booking-item-features-rentals {
  margin-top: 10px;
}
.booking-item-features-rentals > li {
  margin-bottom: 0;
}
.booking-item-car-title {
  margin-top: 7px;
  font-size: 12px;
  line-height: 1em;
  margin-bottom: 0;
}
.booking-item-features-sign > li {
  padding-bottom: 15px;
}
.booking-item-features-small > li {
  margin-right: 5px;
  margin-bottom: 5px;
}
.booking-item-features-small > li > i {
  width: 30px;
  height: 30px;
  line-height: 30px;
  font-size: 17px;
}
.booking-item-features-small > li > i > img {
  width: 20px;
}
.booking-item-features-expand {
  display: block;
}
.booking-item-features-expand .booking-item-feature-title {
  position: relative;
  line-height: 37px;
  margin-left: 7px;
  color: #686868;
}
.booking-item-features-expand > li {
  float: none;
  display: block;
  overflow: hidden;
}
.booking-item-features-expand > li:after {
  content: '.';
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.booking-item-features-expand > li > i {
  float: left;
}
.booking-item-features-2-col > li {
  float: left;
  width: 50%;
  margin-right: 0;
}
.booking-item-container .booking-item-details {
  height: 0;
  overflow: hidden;
  -webkit-transition: opacity 0.3s, -webkit-transform 0.3s, height 0.3s;
  -moz-transition: opacity 0.3s, -moz-transform 0.3s, height 0.3s;
  -o-transition: opacity 0.3s, -o-transform 0.3s, height 0.3s;
  -ms-transition: opacity 0.3s, -ms-transform 0.3s, height 0.3s;
  transition: opacity 0.3s, transform 0.3s, height 0.3s;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transform: translate3d(0, -10px, 0);
  -moz-transform: translate3d(0, -10px, 0);
  -o-transform: translate3d(0, -10px, 0);
  -ms-transform: translate3d(0, -10px, 0);
  transform: translate3d(0, -10px, 0);
}
.booking-item-container .booking-item-details h5 {
  font-size: 13px;
  font-weight: 400;
  margin-bottom: 20px;
}
.booking-item-container .booking-item-details h5.list-title {
  margin-bottom: 0;
}
.booking-item-container .booking-item-details .list {
  margin-bottom: 20px;
}
.booking-item-container.active .booking-item-details {
  height: auto;
  /*overflow: auto;*/
  padding: 15px;
  border: 1px solid #e6e6e6;
  border-top: none;
  position: relative;
  font-size: 11px;
  line-height: 1.6em;
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.booking-title {
  margin-bottom: 25px;
  margin-top: 15px;
}
.booking-title > small {
  font-size: 12px;
  margin-left: 5px;
}
.booking-filters {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  font-size: 11px;
  background: #4d4d4d;
  color: #fff;
  padding: 15px 0;
  width: 263px;
  border: 1px solid #262626;
}
.booking-filters > h3 {
  padding: 0 20px;
}
.booking-filters .booking-filters-list > li {
  margin-top: 0px;
  padding: 15px 20px 0 20px;
  border-top: 1px solid #3b3b3b;
}
.booking-filters .booking-filters-list > li .booking-filters-title {
  margin-bottom: 5px;
}
.booking-filters .booking-filters-list > li .booking-filters-title small {
  font-size: 11px;
  font-weight: 400;
  position: relative;
  top: 10px;
  float: right;
  line-height: 1.3em;
  color: #ccc;
}
.booking-filters .booking-filters-list > li .booking-filters-sub-title {
  font-size: 15px;
  line-height: 1em;
  margin-top: 10px;
}
.booking-filters .irs-from,
.booking-filters .irs-to,
.booking-filters .irs-single {
  color: #fff;
}
.booking-filters .irs-grid-text {
  color: #d9d9d9;
}
.booking-filters.booking-filters-white {
  color: #737373;
  background: #fafafa;
  border-color: #ccc;
}
.booking-filters.booking-filters-white .irs-from,
.booking-filters.booking-filters-white .irs-to,
.booking-filters.booking-filters-white .irs-single {
  color: #737373;
}
.booking-filters.booking-filters-white .booking-filters-list > li {
  border-color: #ccc;
}
.booking-sort {
  font-size: 10px;
}
.booking-sort .booking-sort-title {
  font-size: 14px;
}
.booking-sort .booking-sort-title > a {
  color: #737373;
}
.booking-item-meta .booking-item-rating {
  border: none;
  padding: 0;
  margin-bottom: 30px;
  display: block;
}
.booking-item-meta .booking-item-rating-stars {
  font-size: 30px;
  margin-bottom: -3px;
  margin-right: 10px;
}
.booking-item-meta .booking-item-rating-number {
  font-size: 20px;
}
.booking-item-meta .booking-item-rating-number b {
  font-size: 30px;
}
.booking-item-raiting-list,
.booking-item-raiting-summary-list {
  font-size: 13px;
  margin-bottom: 30px;
}
.booking-item-raiting-list > li,
.booking-item-raiting-summary-list > li {
  margin-bottom: 5px;
  overflow: hidden;
}
.booking-item-raiting-list > li > div,
.booking-item-raiting-summary-list > li > div {
  height: 26px;
  float: left;
  line-height: 26px;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-title,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 24%;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar {
  width: 60%;
  background: #e6e6e6;
  height: 20px;
  margin-top: 3px;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar > div,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar > div {
  background: #ed8323;
  height: 100%;
}
.booking-item-raiting-list > li > div.booking-item-raiting-list-number,
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-number {
  margin-left: 2%;
  width: 10%;
}
.booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 48%;
}
.booking-item-raiting-summary-list > li .booking-item-rating-stars {
  font-size: 14px;
  line-height: 26px;
  margin: 0;
  color: #ed8323;
}
.booking-item-reviews > li {
  margin-bottom: 20px;
}
.booking-item-reviews > li .booking-item-review-person p {
  line-height: 1em;
}
.booking-item-reviews > li .booking-item-review-person-avatar {
  display: table;
  margin-bottom: 8px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.booking-item-reviews > li .booking-item-review-person-avatar:hover {
  -webkit-box-shadow: 0 0 0 2px #ed8323;
  box-shadow: 0 0 0 2px #ed8323;
}
.booking-item-reviews > li .booking-item-review-person-avatar > img {
  max-width: 70px;
}
.booking-item-reviews > li .booking-item-review-person-name {
  margin-bottom: 5px;
}
.booking-item-reviews > li .booking-item-review-person-loc {
  margin-bottom: 0px;
  font-size: 11px;
}
.booking-item-reviews > li .booking-item-review-content {
  padding: 15px 17px;
  border: 1px solid #e6e6e6;
  position: relative;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-reviews > li .booking-item-review-content:before {
  z-index: 2;
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-top: 15px solid transparent;
  border-right: 20px solid #ededed;
  border-bottom: 15px solid transparent;
  left: -20px;
  top: 14px;
}
.booking-item-reviews > li .booking-item-review-content > h5 {
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-raiting-summary-list > li > div.booking-item-raiting-list-title {
  width: 75px;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-raiting-summary-list > li .booking-item-rating-stars {
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-more,
.booking-item-reviews > li .booking-item-review-content .booking-item-review-more-content {
  display: none;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand {
  position: relative;
  height: 30px;
  cursor: pointer;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span {
  color: #ed8323;
  line-height: 30px;
  height: 30px;
  display: block;
  position: absolute;
  font-size: 14px;
}
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span.booking-item-review-expand-less {
  display: none;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-more {
  display: inline;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-more-content {
  display: block;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-expand  span.booking-item-review-expand-less {
  display: block;
}
.booking-item-reviews > li .booking-item-review-content.expanded .booking-item-review-expand  span.booking-item-review-expand-more {
  display: none;
}
.booking-item-reviews > li .booking-item-raiting-summary-list {
  margin-bottom: 10px;
}
.booking-item-reviews > li .booking-item-rating-stars {
  font-size: 14px;
  color: #ed8323;
  margin-bottom: 5px;
}
.booking-item-reviews > li .booking-item-review-rate {
  line-height: 30px;
  font-size: 12px;
  margin-bottom: 0;
}
.booking-item-reviews > li .booking-item-review-rate .fa {
  margin-left: 7px;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars {
  color: #b3b3b3;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li {
  cursor: pointer;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li.hovered {
  color: #808080;
}
.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li.selected {
  color: #ed8323;
}
.booking-item-deails-date-location {
  padding: 15px 17px;
  background: #f7f7f7;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  border: 1px solid #ed8323;
}
.booking-item-deails-date-location > ul {
  font-size: 12px;
  list-style: none;
  margin: 0 0 30px 0;
  padding: 0;
}
.booking-item-deails-date-location > ul > li {
  margin-bottom: 15px;
}
.booking-item-deails-date-location > ul > li p {
  margin-bottom: 5px;
}
.booking-item-deails-date-location > ul > li p > i {
  margin-right: 7px;
  height: 23px;
  width: 23px;
  line-height: 23px;
  font-size: 11px;
}
.booking-item-deails-date-location > ul > li h5 {
  font-size: 14px;
  margin-bottom: 5px;
  color: #515151;
}
.booking-item-price-calc {
  font-size: 13px;
}
.booking-item-price-calc .checkbox {
  margin-bottom: 5px;
  margin-top: 0;
}
.booking-item-price-calc .checkbox label {
  font-weight: 100;
}
.booking-item-price-calc .icheck {
  width: 20px;
  height: 20px;
  line-height: 18px;
  top: 2px;
}
.booking-item-price-calc .list {
  margin-bottom: 10px;
}
.booking-item-price-calc .list > li {
  margin-bottom: 7px;
}
.booking-item-price-calc .list > li > small {
  display: block;
  font-size: 11px;
}
.booking-item-price-calc .list > li > p {
  height: 25px;
  line-height: 25px;
  margin-bottom: 0;
}
.booking-item-price-calc .list > li > p span {
  float: right;
}
.booking-item-price-calc .list > li:last-child {
  padding-top: 7px;
  border-top: 1px solid #ccc;
  color: #5c5c5c;
}
.booking-item-price-calc .list > li:last-child > p > span {
  font-size: 15px;
  font-weight: 600;
}
.booking-item-passengers > li {
  margin-top: 20px;
  padding-top: 20px;
  border-top: 2px dashed #e6e6e6;
}
.booking-item-passengers > li:last-child {
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 2px dashed #e6e6e6;
}
.booking-item-passengers label {
  font-weight: 100;
  font-size: 13px;
}
.booking-item-payment-total-flight {
  list-style: none;
  margin: 0;
  padding: 0;
  background: #f2f2f2;
  margin-right: 30px;
}
.booking-item-payment-total-flight > li {
  padding: 10px 15px;
  background: #4d4d4d;
  color: #e6e6e6;
}
.booking-item-payment-total-flight > li:first-child {
  border-bottom: 1px dashed #1a1a1a;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
.booking-item-payment-total-flight > li:first-child > h5 {
  line-height: 1em;
  margin: 3px 0;
  color: #f09644;
}
.booking-item-payment-total-flight > li:last-child {
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
.booking-item-payment-total-flight > li.booking-item-payment-total-flight-wait {
  background: #333;
}
.booking-item-payment-total-flight > li.booking-item-payment-total-flight-wait > p {
  font-size: 13px;
  line-height: 1.4em;
  margin: 0;
  text-align: center;
}
.booking-item-payment-total-flight > li h5 {
  color: #fff;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival .fa-plane {
  font-size: 20px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure h5,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival h5 {
  font-size: 14px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-arrival .booking-item-date {
  padding-left: 23px;
  font-size: 11px;
}
.booking-item-payment-total-flight > li .booking-item-flight-details .booking-item-destination {
  font-size: 12px;
}
.booking-item-payment-total-flight > li .booking-item-flight-duration > p {
  margin-bottom: 5px;
  line-height: 1em;
  font-size: 13px;
}
.booking-item-payment-total-flight > li .booking-item-flight-duration > h5 {
  font-weight: 400;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .fa-plane {
  font-size: 20px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure h5,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival h5 {
  font-size: 14px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .booking-item-date {
  padding-left: 23px;
  font-size: 11px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-destination {
  font-size: 12px;
}
.booking-item-payment-flight .booking-item-flight-duration > p {
  margin-bottom: 5px;
  line-height: 1em;
  font-size: 13px;
}
.booking-item-payment-flight .booking-item-flight-duration > h5 {
  font-weight: 400;
}
.booking-item-dates-change {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  padding: 15px 20px;
  border: 1px solid #ed8323;
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.15);
  box-shadow: 0 2px 1px rgba(0,0,0,0.15);
}
.booking-item-payment {
  -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.1);
  box-shadow: 0 2px 1px rgba(0,0,0,0.1);
  border: 1px solid rgba(0,0,0,0.15);
}
.booking-item-payment > header {
  padding: 10px 15px;
  background: #f7f7f7;
}
.booking-item-payment > header .booking-item-payment-img {
  float: left;
  display: block;
  width: 30%;
  margin-right: 5%;
}
.booking-item-payment > header .booking-item-payment-title {
  font-size: 14px;
  margin-bottom: 0;
}
.booking-item-payment > header .booking-item-rating-stars {
  font-size: 11px;
}
.booking-item-payment .booking-item-payment-total {
  margin-bottom: 0;
  padding: 8px 30px 8px 15px;
  font-size: 12px;
}
.booking-item-payment .booking-item-payment-total > span {
  font-size: 24px;
  color: #686868;
  font-weight: 400;
  letter-spacing: -2px;
}
.booking-item-payment .booking-item-payment-details {
  list-style: none;
  margin: 0;
  padding: 15px;
  border-top: 1px solid #d9d9d9;
  border-bottom: 1px solid #d9d9d9;
}
.booking-item-payment .booking-item-payment-details > li {
  margin-bottom: 20px;
  overflow: hidden;
}
.booking-item-payment .booking-item-payment-details > li:last-child {
  margin-bottom: 0;
}
.booking-item-payment .booking-item-payment-details > li > h5 {
  line-height: 1em;
}
.booking-item-payment .booking-item-payment-details > li > p {
  margin-bottom: 0;
  color: #686868;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-item-title {
  color: #515151;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date,
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date-separator {
  float: left;
  display: block;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date-separator {
  width: 15%;
  text-align: center;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date .booking-item-payment-date-day {
  margin-bottom: 5px;
  line-height: 1em;
  color: #686868;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-date .booking-item-payment-date-weekday {
  font-size: 12px;
  margin-bottom: 0;
  line-height: 1em;
  color: #7a7a7a;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price {
  margin: 0;
  padding: 0;
  list-style: none;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li {
  width: 70%;
  overflow: hidden;
  font-size: 12px;
  border-bottom: 1px dashed #d9d9d9;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-title,
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: left;
  margin: 0;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: right;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount > small {
  margin-left: 3px;
}
.booking-item-details .booking-item-header {
  margin-bottom: 20px;
  margin-top: 15px;
  padding-top: 15px;
  border-top: 1px solid #f2f2f2;
}
.booking-item-details .booking-item-header-price {
  font-size: 19px;
  text-align: right;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price .text-lg {
  font-size: 42px;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price small {
  font-size: 13px;
}
.booking-details-tabbable .nav > li > a > .fa {
  margin-right: 5px;
  opacity: 0.6;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
  filter: alpha(opacity=60);
  font-size: 13px;
  position: relative;
  top: -1px;
}
.booking-details-tabbable .nav > li.active > a > .fa {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.booking-list-wishlist > li {
  padding-top: 30px;
  padding-right: 25px;
}
.booking-list-wishlist > li .booking-item-wishlist-title {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  border: 1px solid #f2f2f2;
  background: #f7f7f7;
  border-bottom: none;
  font-size: 12px;
  -webkit-border-radius: 3px 3px 0 0;
  border-radius: 3px 3px 0 0;
}
.booking-list-wishlist > li .booking-item-wishlist-title > span {
  font-size: 9px;
  color: #8f8f8f;
  margin-left: 5px;
}
.booking-list-wishlist > li .booking-item-wishlist-remove {
  position: absolute;
  top: 30px;
  right: 0;
  display: block;
  width: 25px;
  height: 25px;
  line-height: 25px;
  background: #e6e6e6;
  color: #737373;
  text-align: center;
  -webkit-transition: 0.1s;
  -moz-transition: 0.1s;
  -o-transition: 0.1s;
  -ms-transition: 0.1s;
  transition: 0.1s;
}
.booking-list-wishlist > li .booking-item-wishlist-remove:hover {
  background: #4d4d4d;
  color: #fff;
}
.user-profile-sidebar {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  margin-right: 30px;
  padding: 20px 0;
  background: #4d4d4d;
  color: #fff;
  margin-bottom: 30px;
}
.user-profile-sidebar .user-profile-avatar {
  padding: 0 20px;
  margin-bottom: 20px;
}
.user-profile-sidebar .user-profile-avatar img {
  max-width: 120px;
  margin-bottom: 15px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.user-profile-sidebar .user-profile-avatar h5 {
  color: #fff;
  margin-bottom: 0;
  font-size: 16px;
}
.user-profile-sidebar .user-profile-avatar p {
  font-size: 10px;
}
.user-profile-sidebar .user-profile-nav > li {
  border-bottom: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li:first-child {
  border-top: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li.active > a {
  background: #ed8323;
  color: #fff;
  cursor: default;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover {
  background: #ed8323;
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover > i {
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li > a {
  padding: 10px 20px;
  color: #d9d9d9;
  display: block;
  font-size: 13px;
}
.user-profile-sidebar .user-profile-nav > li > a:hover {
  color: #fff;
  background: #404040;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.user-profile-sidebar .user-profile-nav > li > a:hover > i {
  color: #ed8323;
}
.user-profile-sidebar .user-profile-nav > li > a > i {
  margin-right: 7px;
  display: inline-block;
  width: 20px;
  text-align: center;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.user-profile-statictics > li {
  margin-right: 20px;
  text-align: center;
  padding: 20px;
  border: 1px solid #e6e6e6;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  width: 153px;
}
.user-profile-statictics > li:last-child {
  margin-right: 0;
}
.user-profile-statictics > li .user-profile-statictics-icon {
  font-size: 70px;
  display: inline-block;
  margin-bottom: 10px;
  color: #8c8c8c;
}
.user-profile-statictics > li h5 {
  font-size: 30px;
  margin-bottom: 0;
  line-height: 1em;
  margin-bottom: 3px;
  color: #ed8323;
}
.user-profile-statictics > li p {
  margin-bottom: 0;
  line-height: 1em;
  font-size: 13px;
}
.table-booking-history {
  font-size: 12px;
}
.table-booking-history .booking-history-type {
  text-align: center;
}
.table-booking-history .booking-history-type > i {
  display: block;
  font-size: 25px;
  color: #626262;
  margin-bottom: 2px;
}
.table-booking-history .booking-history-type > small {
  line-height: 1em;
  display: block;
}
.table-booking-history .booking-history-title {
  width: 22%;
  color: #565656;
}
.irs {
  position: relative;
  display: block;
  height: 40px;
}
.irs-line {
  position: relative;
  display: block;
  overflow: hidden;
  height: 12px;
  top: 25px;
  background: #ccc;
}
.irs-line-left,
.irs-line-mid,
.irs-line-right {
  position: absolute;
  display: block;
  top: 0;
  height: 12px;
}
.irs-line-left {
  left: 0;
  width: 10%;
}
.irs-line-mid {
  left: 10%;
  width: 10%;
}
.irs-line-right {
  right: 0;
  width: 10%;
}
.irs-diapason {
  position: absolute;
  display: block;
  left: 0;
  width: 100%;
  height: 12px;
  top: 25px;
  background: #ed8323;
}
.irs-slider {
  position: absolute;
  display: block;
  left: 0;
  width: 5px;
  height: 18px;
  top: 22px;
  background: #c96810;
  cursor: pointer;
}
.irs-slider.single {
  left: 10px;
}
.irs-slider.single:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  left: -30%;
  width: 160%;
  height: 160%;
}
.irs-slider.from {
  left: 100px;
}
.irs-slider.from:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  left: 0;
  width: 200%;
  height: 170%;
}
.irs-slider.to {
  left: 300px;
}
.irs-slider.to:before {
  content: '';
  position: absolute;
  display: block;
  top: -30%;
  right: 0;
  width: 200%;
  height: 170%;
}
.irs-slider.last {
  z-index: 2;
}
.irs-min,
.irs-max {
  position: absolute;
  display: block;
  cursor: default;
  color: #b3b3b3;
  font-size: 10px;
  line-height: 1.333;
  top: 4px;
}
.irs-min {
  left: 0;
}
.irs-max {
  right: 0;
}
.irs-from,
.irs-to,
.irs-single {
  position: absolute;
  display: block;
  top: 2px;
  left: 0;
  cursor: default;
  white-space: nowrap;
  color: #666;
  font-size: 13px;
  line-height: 1.333;
}
.irs-grid {
  position: absolute;
  display: none;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 20px;
}
.irs-with-grid {
  height: 60px;
}
.irs-with-grid .irs-grid {
  display: block;
}
.irs-grid-pol {
  position: absolute;
  top: 0;
  left: 0;
  width: 1px;
  height: 8px;
  background: #b3b3b3;
}
.irs-grid-pol.small {
  height: 4px;
}
.irs-grid-text {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100px;
  white-space: nowrap;
  text-align: center;
  font-size: 9px;
  line-height: 9px;
  color: #808080;
}
.irs-disable-mask {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  cursor: default;
  background: #000;
  z-index: 2;
}
.irs-disabled {
  opacity: 0.4;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
  filter: alpha(opacity=40);
}
.i-check,
.i-radio {
  display: inline-block;
  *display: inlne;
  vertical-align: middle;
  margin: 0;
  padding: 0;
  width: 22px;
  height: 22px;
  border: 1px solid #ccc;
  cursor: pointer;
  top: 1px;
  left: -7px;
  margin-left: -13px;
  float: left;
  text-align: center;
  line-height: 20px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  position: relative;
  overflow: hidden;
}
.i-check:before,
.i-radio:before {
  content: '\f00c';
  font-family: 'FontAwesome';
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translate3d(0, -25px, 0);
  -moz-transform: translate3d(0, -25px, 0);
  -o-transform: translate3d(0, -25px, 0);
  -ms-transform: translate3d(0, -25px, 0);
  transform: translate3d(0, -25px, 0);
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  color: #fff;
  font-size: 14px;
}
.i-check.hover,
.i-radio.hover {
  border: 1px solid #ed8323;
}
.i-check.checked,
.i-radio.checked {
  border: 1px solid #ed8323;
  background: #ed8323;
}
.i-check.checked:before,
.i-radio.checked:before {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.i-check.disabled,
.i-radio.disabled {
  border-color: #d9d9d9 !important;
}
.i-check.disabled.checked,
.i-radio.disabled.checked {
  background: #ccc !important;
}
.i-check.i-check-stroke.checked {
  background: #fff;
}
.i-check.i-check-stroke.checked:before {
  color: #ed8323;
}
.i-radio {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.i-radio:before {
  content: '\f111';
  font-size: 12px;
}
.checkbox-switch .i-check,
.radio-switch .i-check,
.checkbox-switch .i-radio,
.radio-switch .i-radio {
  -webkit-border-radius: 0;
  border-radius: 0;
  width: 44px;
  broder-color: #999;
  border-width: 2px;
}
.checkbox-switch .i-check:before,
.radio-switch .i-check:before,
.checkbox-switch .i-radio:before,
.radio-switch .i-radio:before {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  background: #b3b3b3;
  content: '';
  width: 16px;
  height: 14px;
  top: 2px;
  left: 2px;
  position: absolute;
}
.checkbox-switch .i-check.checked,
.radio-switch .i-check.checked,
.checkbox-switch .i-radio.checked,
.radio-switch .i-radio.checked {
  background: #fff;
}
.checkbox-switch .i-check.checked:before,
.radio-switch .i-check.checked:before,
.checkbox-switch .i-radio.checked:before,
.radio-switch .i-radio.checked:before {
  background: #ed8323;
  -webkit-transform: translate3d(20px, 0, 0);
  -moz-transform: translate3d(20px, 0, 0);
  -o-transform: translate3d(20px, 0, 0);
  -ms-transform: translate3d(20px, 0, 0);
  transform: translate3d(20px, 0, 0);
}
.checkbox-switch .i-check.disabled:before,
.radio-switch .i-check.disabled:before,
.checkbox-switch .i-radio.disabled:before,
.radio-switch .i-radio.disabled:before {
  background: #ccc !important;
}
.checkbox-small,
.radio-small {
  margin-bottom: 10px;
}
.checkbox-small.checkbox-inline,
.radio-small.checkbox-inline,
.checkbox-small.radio-inline,
.radio-small.radio-inline {
  margin: 0;
}
.checkbox-small label,
.radio-small label {
  font-size: 12px;
}
.checkbox-small label .i-check,
.radio-small label .i-check,
.checkbox-small label .i-radio,
.radio-small label .i-radio {
  width: 18px;
  height: 18px;
  line-height: 16px;
  top: 3px;
}
.checkbox-small label .i-check:before,
.radio-small label .i-check:before,
.checkbox-small label .i-radio:before,
.radio-small label .i-radio:before {
  font-size: 12px;
}
.checkbox-small label .i-radio:before,
.radio-small label .i-radio:before {
  font-size: 9px;
}
.checkbox-lg,
.radio-lg {
  margin-bottom: 20px;
}
.checkbox-lg.checkbox-inline,
.radio-lg.checkbox-inline,
.checkbox-lg.radio-inline,
.radio-lg.radio-inline {
  margin: 0;
}
.checkbox-lg label,
.radio-lg label {
  font-size: 16px;
}
.checkbox-lg label .i-check,
.radio-lg label .i-check,
.checkbox-lg label .i-radio,
.radio-lg label .i-radio {
  width: 26px;
  height: 26px;
  line-height: 24px;
  top: -1px;
}
.checkbox-lg label .i-check:before,
.radio-lg label .i-check:before,
.checkbox-lg label .i-radio:before,
.radio-lg label .i-radio:before {
  font-size: 16px;
}
.checkbox-lg label .i-radio:before,
.radio-lg label .i-radio:before {
  font-size: 14px;
}
.checkbox-stroke .i-check.checked,
.radio-stroke .i-check.checked,
.checkbox-stroke .i-radio.checked,
.radio-stroke .i-radio.checked {
  background: #fff;
}
.checkbox-stroke .i-check.checked:before,
.radio-stroke .i-check.checked:before,
.checkbox-stroke .i-radio.checked:before,
.radio-stroke .i-radio.checked:before {
  color: #ed8323;
}
.checkbox-stroke .i-check.checked.disabled,
.radio-stroke .i-check.checked.disabled,
.checkbox-stroke .i-radio.checked.disabled,
.radio-stroke .i-radio.checked.disabled {
  background: #fff;
}
.checkbox-stroke .i-check.checked.disabled:before,
.radio-stroke .i-check.checked.disabled:before,
.checkbox-stroke .i-radio.checked.disabled:before,
.radio-stroke .i-radio.checked.disabled:before {
  color: #ccc;
}
.checkbox-small.checkbox-inline + .checkbox-small.checkbox-inline,
.radio-small.radio-inline + .radio-small.radio-inline {
  margin-left: 10px;
}
.checkbox-lg.checkbox-inline + .checkbox-lg.checkbox-inline,
.radio-lg.radio-inline + .radio-lg.radio-inline {
  margin-left: 20px;
}
.fotorama__html,
.fotorama__stage__frame,
.fotorama__stage__shaft,
.fotorama__video iframe {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}
.fotorama--fullscreen,
.fotorama__img {
  max-width: 99999px !important;
  max-height: 99999px !important;
  min-width: 0 !important;
  min-height: 0 !important;
  -webkit-border-radius: 0 !important;
  border-radius: 0 !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  padding: 0 !important;
}
.fotorama__wrap .fotorama__grab {
  cursor: grab;
}
.fotorama__grabbing * {
  cursor: grabbing;
}
.fotorama__img,
.fotorama__spinner {
  position: absolute !important;
  top: 50% !important;
  left: 50% !important;
}
.fotorama__img {
  margin: -50% 0 0 -50%;
  width: 100%;
  height: 100%;
}
.fotorama__wrap--css3 .fotorama__arr,
.fotorama__wrap--css3 .fotorama__fullscreen-icon,
.fotorama__wrap--css3 .fotorama__nav__shaft,
.fotorama__wrap--css3 .fotorama__stage__shaft,
.fotorama__wrap--css3 .fotorama__thumb-border,
.fotorama__wrap--css3 .fotorama__video-close,
.fotorama__wrap--css3 .fotorama__video-play {
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.fotorama__caption,
.fotorama__nav:after,
.fotorama__nav:before,
.fotorama__stage:after,
.fotorama__stage:before,
.fotorama__wrap--css3 .fotorama__html,
.fotorama__wrap--css3 .fotorama__nav,
.fotorama__wrap--css3 .fotorama__spinner,
.fotorama__wrap--css3 .fotorama__stage,
.fotorama__wrap--css3 .fotorama__stage .fotorama__img,
.fotorama__wrap--css3 .fotorama__stage__frame {
  -webkit-transform: translateZ(0);
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -o-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.fotorama__wrap--video .fotorama__stage,
.fotorama__wrap--video .fotorama__stage__frame--video,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img,
.fotorama__wrap--video .fotorama__stage__shaft {
  -webkit-transform: none !important;
  -webkit-transform: none !important;
  -moz-transform: none !important;
  -o-transform: none !important;
  -ms-transform: none !important;
  transform: none !important;
}
.fotorama__wrap--css3 .fotorama__nav__shaft,
.fotorama__wrap--css3 .fotorama__stage__shaft,
.fotorama__wrap--css3 .fotorama__thumb-border {
  -webkit-transition-property: -webkit-transform;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  -o-transition-property: -o-transform;
  -ms-transition-property: -ms-transform;
  transition-property: transform;
  -webkit-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -webkit-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -moz-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -o-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -ms-transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  transition-timing-function: cubic-bezier(0.1, 0, 0.25, 1);
  -webkit-transition-duration: 0ms;
  -webkit-transition-duration: 0ms;
  -moz-transition-duration: 0ms;
  -o-transition-duration: 0ms;
  -ms-transition-duration: 0ms;
  transition-duration: 0ms;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__no-select,
.fotorama__video-close,
.fotorama__video-play,
.fotorama__wrap {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.fotorama__select {
  -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
  -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
  user-select: text;
}
.fotorama__nav,
.fotorama__nav__frame {
  margin: 0;
  padding: 0;
}
.fotorama__caption__wrap,
.fotorama__nav__frame,
.fotorama__nav__shaft {
  -moz-box-orient: vertical;
  display: inline-block;
  vertical-align: middle;
  *display: inline;
  *zoom: 1;
}
.fotorama__wrap * {
  -moz-box-sizing: content-box;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.fotorama__caption__wrap {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.fotorama--hidden,
.fotorama__load {
  position: absolute;
  left: -99999px;
  top: -99999px;
  z-index: -1;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__nav,
.fotorama__nav__frame,
.fotorama__nav__shaft,
.fotorama__stage__frame,
.fotorama__stage__shaft,
.fotorama__video-close,
.fotorama__video-play {
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}
.fotorama__arr:before,
.fotorama__fullscreen-icon:before,
.fotorama__video-close:before,
.fotorama__video-play:before {
  font-family: 'FontAwesome';
}
.fotorama__thumb {
  background-color: rgba(127,127,127,0.2);
}
.fotorama {
  min-width: 1px;
  overflow: hidden;
}
.fotorama:not(.fotorama--unobtrusive)>:not(:first-child) {
  display: none;
}
.fullscreen {
  width: 100% !important;
  height: 100% !important;
  max-width: 100% !important;
  max-height: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
  overflow: hidden !important;
  background: #000;
}
.fotorama--fullscreen {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  float: none !important;
  z-index: 2147483647 !important;
  background: #000;
  width: 100% !important;
  height: 100% !important;
  margin: 0 !important;
}
.fotorama--fullscreen .fotorama__nav,
.fotorama--fullscreen .fotorama__stage {
  background: #000;
}
.fotorama__wrap {
  -webkit-text-size-adjust: 100%;
  position: relative;
  direction: ltr;
}
.fotorama__wrap--rtl .fotorama__stage__frame {
  direction: rtl;
}
.fotorama__nav,
.fotorama__stage {
  overflow: hidden;
  position: relative;
  max-width: 100%;
}
.fotorama__wrap--pan-y {
  -ms-touch-action: pan-y;
}
.fotorama__wrap .fotorama__pointer {
  cursor: pointer;
}
.fotorama__wrap--slide .fotorama__stage__frame {
  opacity: 1 !important;
  -ms-filter: none;
  filter: none;
}
.fotorama__stage__frame {
  overflow: hidden;
}
.fotorama__stage__frame.fotorama__active {
  z-index: 8;
}
.fotorama__wrap--fade .fotorama__stage__frame {
  display: none;
}
.fotorama__wrap--fade .fotorama__fade-front,
.fotorama__wrap--fade .fotorama__fade-rear,
.fotorama__wrap--fade .fotorama__stage__frame.fotorama__active {
  display: block;
  left: 0;
  top: 0;
}
.fotorama__wrap--fade .fotorama__fade-front {
  z-index: 8;
}
.fotorama__wrap--fade .fotorama__fade-rear {
  z-index: 7;
}
.fotorama__wrap--fade .fotorama__fade-rear.fotorama__active {
  z-index: 9;
}
.fotorama__wrap--fade .fotorama__stage .fotorama__shadow {
  display: none;
}
.fotorama__img {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  border: none !important;
}
.fotorama__error .fotorama__img,
.fotorama__loaded .fotorama__img {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama--fullscreen .fotorama__loaded--full .fotorama__img,
.fotorama__img--full {
  display: none;
}
.fotorama--fullscreen .fotorama__loaded--full .fotorama__img--full {
  display: block;
}
.fotorama__wrap--only-active .fotorama__nav,
.fotorama__wrap--only-active .fotorama__stage {
  max-width: 99999px !important;
}
.fotorama__wrap--only-active .fotorama__stage__frame {
  visibility: hidden;
}
.fotorama__wrap--only-active .fotorama__stage__frame.fotorama__active {
  visibility: visible;
}
.fotorama__nav {
  font-size: 0;
  line-height: 0;
  text-align: center;
  display: none;
  white-space: nowrap;
  z-index: 5;
}
.fotorama__nav__shaft {
  position: relative;
  left: 0;
  top: 0;
  text-align: left;
}
.fotorama__nav__frame {
  position: relative;
  cursor: pointer;
}
.fotorama__nav--dots {
  display: block;
  position: absolute;
  bottom: 0;
}
.fotorama__nav--dots .fotorama__nav__frame {
  width: 18px;
  height: 30px;
}
.fotorama__nav--dots .fotorama__nav__frame--thumb,
.fotorama__nav--dots .fotorama__thumb-border {
  display: none;
}
.fotorama__nav--thumbs {
  display: block;
}
.fotorama__nav--thumbs .fotorama__nav__frame {
  padding-left: 0 !important;
}
.fotorama__nav--thumbs .fotorama__nav__frame:last-child {
  padding-right: 0 !important;
}
.fotorama__nav--thumbs .fotorama__nav__frame--dot {
  display: none;
}
.fotorama__dot {
  display: block;
  width: 6px;
  height: 6px;
  position: relative;
  top: 12px;
  left: 6px;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  background: #fff;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
}
.fotorama__nav__frame.fotorama__active {
  pointer-events: none;
  cursor: default;
}
.fotorama__nav__frame.fotorama__active .fotorama__dot {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__active .fotorama__dot {
  background-color: #fff;
}
.fotorama__thumb {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 100%;
}
.fotorama__thumb-border {
  position: absolute;
  z-index: 9;
  top: 0;
  left: 0;
  border-style: solid;
  border-color: #ed8323;
}
.fotorama__caption {
  position: absolute;
  z-index: 12;
  bottom: 0;
  left: 0;
  right: 0;
  font-size: 14px;
  line-height: 1.5;
  color: #000;
}
.fotorama__caption a {
  text-decoration: none;
  color: #000;
  border-bottom: 1px solid;
  border-color: rgba(0,0,0,0.5);
}
.fotorama__caption a:hover {
  color: #333;
  border-color: rgba(51,51,51,0.5);
}
.fotorama__wrap--rtl .fotorama__caption {
  left: auto;
  right: 0;
}
.fotorama__wrap--no-captions .fotorama__caption,
.fotorama__wrap--video .fotorama__caption {
  display: none;
}
.fotorama__caption__wrap {
  background-color: rgba(255,255,255,0.9);
  padding: 5px 10px;
}
.fotorama__wrap--css3 .fotorama__spinner {
  -webkit-animation: spinner 24s infinite linear;
  -webkit-animation: spinner 24s infinite linear;
  -moz-animation: spinner 24s infinite linear;
  -o-animation: spinner 24s infinite linear;
  -ms-animation: spinner 24s infinite linear;
  animation: spinner 24s infinite linear;
}
.fotorama__wrap--css3 .fotorama__html,
.fotorama__wrap--css3 .fotorama__stage .fotorama__img {
  -webkit-transition-property: opacity;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -ms-transition-property: opacity;
  transition-property: opacity;
  -webkit-transition-timing-function: linear;
  -moz-transition-timing-function: linear;
  -o-transition-timing-function: linear;
  -ms-transition-timing-function: linear;
  transition-timing-function: linear;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html,
.fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__select {
  cursor: auto;
}
.fotorama__video {
  top: 32px;
  right: 0;
  bottom: 0;
  left: 0;
  position: absolute;
  z-index: 10;
}
.fotorama__arr,
.fotorama__fullscreen-icon,
.fotorama__video-close,
.fotorama__video-play {
  position: absolute;
  z-index: 11;
  cursor: pointer;
}
.fotorama__arr {
  text-align: center;
  display: block;
  position: absolute;
  width: 32px;
  height: 32px;
  line-height: 32px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  top: 50%;
  margin: -16px 10px 0 10px;
  background: rgba(0,0,0,0.4);
  color: #fff;
  font-size: 20px;
}
.fotorama__arr:hover {
  background: rgba(0,0,0,0.6);
}
.fotorama__arr--prev {
  left: 0;
}
.fotorama__arr--prev:before {
  content: '\f104';
}
.fotorama__arr--next {
  right: 0;
}
.fotorama__arr--next:before {
  content: '\f105';
}
.fotorama__arr--disabled {
  pointer-events: none;
  cursor: default;
  *display: none;
  opacity: 0.3;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
}
.fotorama__fullscreen-icon {
  width: 32px;
  height: 32px;
  line-height: 32px;
  top: 0;
  right: 0;
  z-index: 20;
  color: #fff;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  background: rgba(0,0,0,0.2);
  text-align: center;
  margin: 10px;
}
.fotorama__fullscreen-icon:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__fullscreen-icon:before {
  content: '\f065';
}
.fotorama--fullscreen .fotorama__fullscreen-icon:before {
  content: '\f066';
}
.fotorama__video-play {
  width: 96px;
  height: 96px;
  left: 50%;
  top: 50%;
  margin-left: -48px;
  margin-top: -48px;
  background-position: 0 -64px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2 .fotorama__video-play,
.fotorama__wrap--video .fotorama__stage .fotorama__video-play {
  display: none;
}
.fotorama__error .fotorama__video-play,
.fotorama__loaded .fotorama__video-play {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  display: block;
}
.fotorama__nav__frame .fotorama__video-play {
  width: 32px;
  height: 32px;
  margin-left: -16px;
  margin-top: -16px;
  background-position: -64px -32px;
}
.fotorama__video-close {
  width: 32px;
  height: 32px;
  top: 0;
  right: 0;
  background-position: -64px 0;
  z-index: 20;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2 .fotorama__video-close {
  display: none;
}
.fotorama__wrap--css3 .fotorama__video-close {
  -webkit-transform: translate3d(32px, -32px, 0);
  -moz-transform: translate3d(32px, -32px, 0);
  -o-transform: translate3d(32px, -32px, 0);
  -ms-transform: translate3d(32px, -32px, 0);
  transform: translate3d(32px, -32px, 0);
}
.fotorama__wrap--video .fotorama__video-close {
  display: block;
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__video-close {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr,
.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon,
.fotorama__wrap--video .fotorama__arr,
.fotorama__wrap--video .fotorama__fullscreen-icon {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.fotorama__wrap--css2.fotorama__wrap--no-controls .fotorama__arr,
.fotorama__wrap--css2.fotorama__wrap--no-controls .fotorama__fullscreen-icon,
.fotorama__wrap--css2.fotorama__wrap--video .fotorama__arr,
.fotorama__wrap--css2.fotorama__wrap--video .fotorama__fullscreen-icon {
  display: none;
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__fullscreen-icon {
  -webkit-transform: translate3d(32px, -32px, 0);
  -moz-transform: translate3d(32px, -32px, 0);
  -o-transform: translate3d(32px, -32px, 0);
  -ms-transform: translate3d(32px, -32px, 0);
  transform: translate3d(32px, -32px, 0);
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--prev,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--prev {
  -webkit-transform: translate3d(-48px, 0, 0);
  -moz-transform: translate3d(-48px, 0, 0);
  -o-transform: translate3d(-48px, 0, 0);
  -ms-transform: translate3d(-48px, 0, 0);
  transform: translate3d(-48px, 0, 0);
}
.fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--next,
.fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--next {
  -webkit-transform: translate3d(48px, 0, 0);
  -moz-transform: translate3d(48px, 0, 0);
  -o-transform: translate3d(48px, 0, 0);
  -ms-transform: translate3d(48px, 0, 0);
  transform: translate3d(48px, 0, 0);
}
.fotorama__wrap--css3 .fotorama__arr,
.fotorama__wrap--css3 .fotorama__fullscreen-icon,
.fotorama__wrap--css3 .fotorama__video-close,
.fotorama__wrap--css3 .fotorama__video-play {
  -webkit-transition-property: -webkit-transform, opacity;
  -moz-transition-property: -moz-transform, opacity;
  -o-transition-property: -o-transform, opacity;
  -ms-transition-property: -ms-transform, opacity;
  transition-property: transform, opacity;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.fotorama__nav:after,
.fotorama__nav:before,
.fotorama__stage:after,
.fotorama__stage:before {
  content: "";
  display: block;
  position: absolute;
  text-decoration: none;
  top: 0;
  bottom: 0;
  width: 10px;
  height: auto;
  z-index: 10;
  pointer-events: none;
  background-repeat: no-repeat;
  -webkit-background-size: 1px 100%, 5px 100%;
  -moz-background-size: 1px 100%, 5px 100%;
  background-size: 1px 100%, 5px 100%;
}
.fotorama__nav:before,
.fotorama__stage:before {
  background-position: 0 0, 0 0;
  left: -10px;
}
.fotorama__nav.fotorama__shadows--left:before,
.fotorama__stage.fotorama__shadows--left:before {
  left: 0;
}
.fotorama__nav:after,
.fotorama__stage:after {
  background-position: 100% 0, 100% 0;
  right: -10px;
}
.fotorama__nav.fotorama__shadows--right:after,
.fotorama__stage.fotorama__shadows--right:after {
  right: 0;
}
.fotorama--fullscreen .fotorama__nav:after,
.fotorama--fullscreen .fotorama__nav:before,
.fotorama--fullscreen .fotorama__stage:after,
.fotorama--fullscreen .fotorama__stage:before,
.fotorama__wrap--fade .fotorama__stage:after,
.fotorama__wrap--fade .fotorama__stage:before,
.fotorama__wrap--no-shadows .fotorama__nav:after,
.fotorama__wrap--no-shadows .fotorama__nav:before,
.fotorama__wrap--no-shadows .fotorama__stage:after,
.fotorama__wrap--no-shadows .fotorama__stage:before {
  display: none;
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-ms-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -o-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.tt-input, .tt-hint {
  color: #999;
}
.tt-dropdown-menu {
  width: 100%;
  margin-top: 7px;
  background: #fff;
  border: 1px solid #e6e6e6;
  max-height: 300px;
  overflow-y: auto;
  white-space: nowrap;
}
.tt-suggestion {
  line-height: 1em;
  padding: 15px 20px;
  font-size: 13px;
  border-bottom: 1px solid #e6e6e6;
}
.tt-suggestion p {
  margin: 0;
}
.tt-suggestion.tt-cursor {
  color: #fff;
  background: #ed8323;
  cursor: pointer;
}
.owl-carousel .owl-wrapper:after {
  content: '.';
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
.owl-carousel {
  /*display: none;*/
  position: relative;
  -ms-touch-action: pan-y;
  margin: 0 -15px;
  padding: 0 45px;
}
.owl-carousel[data-nav="false"] {
  padding: 0 !important;
}
.owl-carousel[data-nav="false"] .owl-buttons {
  display: none !important;
}
.owl-carousel[data-pagination="false"] .owl-pagination {
  display: none !important;
}
.owl-carousel.owl-slider {
  margin: 0;
  padding: 0;
}
.owl-carousel.owl-slider .owl-controls .owl-buttons div.owl-next {
  right: 30px;
}
.owl-carousel.owl-slider .owl-controls .owl-buttons div.owl-prev {
  left: 30px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div {
  top: 20px;
  margin: 0;
  width: 25px;
  height: 25px;
  line-height: 25px;
  font-size: 15px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div.owl-next {
  right: 15px;
}
.owl-carousel.owl-slider[data-nav="top-right"] .owl-buttons div.owl-prev {
  left: auto;
  right: 50px;
}
.owl-carousel.owl-slider .owl-item {
  padding: 0;
}
.owl-carousel .owl-wrapper {
  display: none;
  position: relative;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.owl-carousel .owl-wrapper-outer {
  overflow: hidden;
  position: relative;
  width: 100%;
}
.owl-carousel .owl-wrapper-outer.autoHeight {
  -webkit-transition: height 500ms ease-in-out;
  -moz-transition: height 500ms ease-in-out;
  -o-transition: height 500ms ease-in-out;
  -ms-transition: height 500ms ease-in-out;
  transition: height 500ms ease-in-out;
}
.owl-carousel .owl-item {
  float: left;
  padding: 0 15px;
}
.owl-carousel .owl-item.loading {
  min-height: 150px;
  background: url("AjaxLoader.gif") no-repeat center center;
}
.owl-carousel .owl-item .owl-caption {
  position: absolute;
  z-index: 99;
  background: rgba(0,0,0,0.5);
  padding: 10px 15px;
  color: #fff;
  width: 50%;
}
.top-area .owl-carousel-area .owl-item {
  height: 700px;
}
.special-area .owl-carousel-area .owl-item {
  height: 500px;
}
[data-inner-pagination="true"] .owl-controls .owl-pagination {
  margin: 0;
  position: absolute;
  bottom: 30px;
  width: 100%;
}
[data-white-pagination="true"] .owl-controls .owl-pagination .owl-page span {
  background: #fff;
}
.owl-controls {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: rgba(0,0,0,0.01);
  text-align: center;
}
.owl-controls .owl-pagination {
  margin-top: 10px;
}
@media (max-width:992px) {
  .owl-controls .owl-pagination {
    display: none;
  }
}
.owl-controls .owl-page,
.owl-controls .owl-buttons div {
  cursor: pointer;
  color: #fff;
  display: inline-block;
  zoom: 1;
  *display: inline;
  margin: 5px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.owl-controls .owl-page:hover,
.owl-controls .owl-buttons div:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  text-decoration: none;
}
.owl-controls .owl-page {
  display: inline-block;
  zoom: 1;
  *display: inline;
}
.owl-controls .owl-page span {
  display: block;
  width: 12px;
  height: 12px;
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  background: #ed8323;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.owl-controls .owl-page.active span {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.owl-controls.clickable .owl-page:hover span {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.owl-controls span.owl-numbers {
  height: auto;
  width: auto;
  color: #fff;
  padding: 2px 10px;
  font-size: 12px;
  -webkit-border-radius: 30px;
  border-radius: 30px;
}
.owl-controls .owl-buttons div {
  position: absolute;
  top: 50%;
  width: 30px;
  height: 30px;
  line-height: 30px;
  display: block;
  -webkit-box-shadow: 0 0 0 1px #fff;
  box-shadow: 0 0 0 1px #fff;
  margin: -30px 0 0 0;
  background: rgba(0,0,0,0.2);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  font-size: 17px;
}
.owl-controls .owl-buttons div:hover {
  background: #ed8323;
  -webkit-box-shadow: 0 0 0 1px #ed8323;
  box-shadow: 0 0 0 1px #ed8323;
}
.owl-controls .owl-buttons div:before {
  font-family: 'FontAwesome';
}
.owl-controls .owl-buttons div.owl-next {
  right: 0;
}
.owl-controls .owl-buttons div.owl-next:before {
  content: '\f105';
}
.owl-controls .owl-buttons div.owl-prev {
  left: 0;
}
.owl-controls .owl-buttons div.owl-prev:before {
  content: '\f104';
}
.grabbing {
  cursor: url("../img/grabbing.png") 8 8, move;
}
.owl-carousel .owl-wrapper,
.owl-carousel .owl-item {
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.owl-origin {
  -webkit-perspective: 1200px;
  -moz-perspective: 1200px;
  -ms-perspective: 1200px;
  perspective: 1200px;
  perspective-x: 50%;
  perspective-y: 50%;
}
.owl-fade-out {
  z-index: 10;
  -webkit-animation: fadeOut 0.7s both ease;
  -moz-animation: fadeOut 0.7s both ease;
  -o-animation: fadeOut 0.7s both ease;
  -ms-animation: fadeOut 0.7s both ease;
  animation: fadeOut 0.7s both ease;
}
.owl-fade-in {
  -webkit-animation: fadeIn 0.7s both ease;
  -moz-animation: fadeIn 0.7s both ease;
  -o-animation: fadeIn 0.7s both ease;
  -ms-animation: fadeIn 0.7s both ease;
  animation: fadeIn 0.7s both ease;
}
.owl-backSlide-out {
  -webkit-animation: backSlideOut 1s both ease;
  -moz-animation: backSlideOut 1s both ease;
  -o-animation: backSlideOut 1s both ease;
  -ms-animation: backSlideOut 1s both ease;
  animation: backSlideOut 1s both ease;
}
.owl-backSlide-in {
  -webkit-animation: backSlideIn 1s both ease;
  -moz-animation: backSlideIn 1s both ease;
  -o-animation: backSlideIn 1s both ease;
  -ms-animation: backSlideIn 1s both ease;
  animation: backSlideIn 1s both ease;
}
.owl-goDown-out {
  -webkit-animation: scaleToFade 0.7s ease both;
  -moz-animation: scaleToFade 0.7s ease both;
  -o-animation: scaleToFade 0.7s ease both;
  -ms-animation: scaleToFade 0.7s ease both;
  animation: scaleToFade 0.7s ease both;
}
.owl-goDown-in {
  -webkit-animation: goDown 0.6s ease both;
  -moz-animation: goDown 0.6s ease both;
  -o-animation: goDown 0.6s ease both;
  -ms-animation: goDown 0.6s ease both;
  animation: goDown 0.6s ease both;
}
.owl-fadeUp-in {
  -webkit-animation: scaleUpFrom 0.5s ease both;
  -moz-animation: scaleUpFrom 0.5s ease both;
  -o-animation: scaleUpFrom 0.5s ease both;
  -ms-animation: scaleUpFrom 0.5s ease both;
  animation: scaleUpFrom 0.5s ease both;
}
.owl-fadeUp-out {
  -webkit-animation: scaleUpTo 0.5s ease both;
  -moz-animation: scaleUpTo 0.5s ease both;
  -o-animation: scaleUpTo 0.5s ease both;
  -ms-animation: scaleUpTo 0.5s ease both;
  animation: scaleUpTo 0.5s ease both;
}
.owl-cap-title {
  line-height: 1em;
  font-size: 120px;
  display: table;
  margin: 10px auto;
  padding: 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.2);
  border-top: 1px solid rgba(255,255,255,0.2);
  text-transform: uppercase;
}
@media (max-width:992px) {
  .owl-cap-title {
    font-size: 60px;
  }
}
.owl-cap-price {
  margin-bottom: 15px;
}
.owl-cap-price small {
  font-size: 20px;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
  display: block;
}
.owl-cap-price h5 {
  font-size: 50px;
  color: #ef8f39;
  line-height: 1em;
  margin: 0;
}
.owl-cap-weather {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.owl-cap-weather .im {
  font-size: 60px;
}
.owl-cap-weather span {
  font-size: 25px;
  position: relative;
  top: -10px;
  margin-right: 15px;
}
.owl-cap-weather span:after {
  content: '';
  height: 7px;
  width: 7px;
  position: absolute;
  top: 3px;
  right: -7px;
  border: 2px solid #fff;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.header-contact {
  color: #fff;
}
@-moz-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes empty {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-o-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-ms-keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@keyframes fadeIn {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }
}
@-moz-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-webkit-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-o-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-ms-keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@keyframes fadeOut {
  0% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
  }

  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
  }
}
@-moz-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-webkit-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-o-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-ms-keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@keyframes backSlideOut {
  25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }

  100% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(-200%);
    -moz-transform: translateZ(-500px) translateX(-200%);
    -o-transform: translateZ(-500px) translateX(-200%);
    -ms-transform: translateZ(-500px) translateX(-200%);
    transform: translateZ(-500px) translateX(-200%);
  }
}
@-moz-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-webkit-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-o-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-ms-keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@keyframes backSlideIn {
  0%, 25% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px) translateX(200%);
    -moz-transform: translateZ(-500px) translateX(200%);
    -o-transform: translateZ(-500px) translateX(200%);
    -ms-transform: translateZ(-500px) translateX(200%);
    transform: translateZ(-500px) translateX(200%);
  }

  75% {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    -webkit-transform: translateZ(-500px);
    -moz-transform: translateZ(-500px);
    -o-transform: translateZ(-500px);
    -ms-transform: translateZ(-500px);
    transform: translateZ(-500px);
  }

  100% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    -webkit-transform: translateZ(0) translateX(0);
    -moz-transform: translateZ(0) translateX(0);
    -o-transform: translateZ(0) translateX(0);
    -ms-transform: translateZ(0) translateX(0);
    transform: translateZ(0) translateX(0);
  }
}
@-moz-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-webkit-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-o-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-ms-keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@keyframes scaleToFade {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@-moz-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-webkit-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-o-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-ms-keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@keyframes goDown {
  0% {
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    transform: translateY(-100%);
  }
}
@-moz-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-webkit-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-o-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-ms-keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@keyframes scaleUpFrom {
  0% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-moz-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-webkit-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-o-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@-ms-keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
@keyframes scaleUpTo {
  100% {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -o-transform: scale(1.5);
    -ms-transform: scale(1.5);
    transform: scale(1.5);
  }
}
.countdown {
  width: 400px;
  overflow: hidden;
  height: 58px;
  margin: 20px 0;
  display: table;
}
.countdown > div {
  display: table-cell;
}
.countdown > div > span {
  display: block;
  text-align: center;
}
span.count {
  font-size: 48px;
  line-height: 48px;
}
.countdown.countdown-inline {
  width: 100%;
  margin: 10px 0 0 0;
  height: auto;
}
.countdown.countdown-inline > div {
  display: inline;
}
.countdown.countdown-inline > div:first-child span.count {
  font-size: 25px;
  font-weight: bold;
  margin-right: 5px;
  color: #ed8323;
}
.countdown.countdown-inline > div:first-child span.title {
  font-size: 20px;
  font-weight: bold;
  display: inline;
  margin-right: 10px;
  color: #ed8323;
}
.countdown.countdown-inline > div:first-child span.count:after,
.countdown.countdown-inline > div:last-child span.count:after {
  content: '';
  margin: 0;
}
.countdown.countdown-inline > div > span {
  display: inline;
  line-height: 1em;
}
.countdown.countdown-inline > div span.count {
  font-size: 20px;
}
.countdown.countdown-inline > div span.count:after {
  content: ':';
  margin: 0 2px;
}
.countdown.countdown-inline > div span.title {
  display: none;
}
.countdown-lg {
  margin: 20px auto;
  padding: 15px 0;
  border-top: 1px solid rgba(255,255,255,0.15);
  border-bottom: 1px solid rgba(255,255,255,0.15);
}
.countdown-lg span.count {
  font-size: 70px;
  margin-bottom: 10px;
}
.countdown-lg > div {
  padding: 0 25px;
}
.countdown-lg .title {
  color: rgba(255,255,255,0.7);
}
.mfp-bg {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1042;
  overflow: hidden;
  position: fixed;
  background: #0b0b0b;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-wrap {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1043;
  position: fixed;
  outline: none !important;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
}
.mfp-container {
  text-align: center;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  padding: 0 8px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.mfp-container:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.mfp-align-top .mfp-container:before {
  display: none;
}
.mfp-content {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin: 0 auto;
  text-align: left;
  z-index: 1045;
}
.mfp-inline-holder .mfp-content,
.mfp-ajax-holder .mfp-content {
  width: 100%;
  cursor: auto;
}
.mfp-ajax-cur {
  cursor: progress;
}
.mfp-zoom-out-cur,
.mfp-zoom-out-cur .mfp-image-holder .mfp-close {
  cursor: zoom-out;
}
.mfp-zoom {
  cursor: zoom-in;
}
.mfp-auto-cursor .mfp-content {
  cursor: auto;
}
.mfp-counter {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.mfp-loading.mfp-figure {
  display: none;
}
.mfp-hide {
  display: none !important;
}
.mfp-preloader {
  color: #ccc;
  position: absolute;
  top: 50%;
  width: auto;
  text-align: center;
  margin-top: -0.8em;
  left: 8px;
  right: 8px;
  z-index: 1044;
}
.mfp-preloader a {
  color: #ccc;
}
.mfp-preloader a:hover {
  color: #fff;
}
.mfp-s-ready .mfp-preloader {
  display: none;
}
.mfp-s-error .mfp-content {
  display: none;
}
button.mfp-close,
button.mfp-arrow {
  overflow: visible;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: block;
  padding: 0;
  z-index: 1046;
}
button::-moz-focus-inner {
  padding: 0;
  margin: 0;
}
.mfp-close {
  width: 44px;
  height: 44px;
  line-height: 44px;
  position: absolute;
  right: 0;
  top: 0;
  text-decoration: none;
  text-align: center;
  opacity: 0.65;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
  filter: alpha(opacity=65);
  padding: 0 0 18px 10px;
  color: #fff;
  font-style: normal;
  font-size: 28px;
}
.mfp-close:hover,
.mfp-close:focus {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-close:active {
  top: 1px;
}
.mfp-close-btn-in .mfp-close {
  color: #333;
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close {
  color: #fff;
  right: -6px;
  text-align: right;
  padding-right: 6px;
  width: 100%;
}
.mfp-counter {
  position: absolute;
  top: 0;
  right: 0;
  color: #ccc;
  font-size: 12px;
  line-height: 18px;
}
.mfp-arrow {
  position: absolute;
  opacity: 0.65;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
  filter: alpha(opacity=65);
  margin: 0;
  top: 50%;
  margin-top: -55px;
  padding: 0;
  width: 90px;
  height: 110px;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}
.mfp-arrow:active {
  margin-top: -54px;
}
.mfp-arrow:hover,
.mfp-arrow:focus {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-arrow:before,
.mfp-arrow:after,
.mfp-arrow .mfp-b,
.mfp-arrow .mfp-a {
  content: '';
  display: block;
  width: 0;
  height: 0;
  position: absolute;
  left: 0;
  top: 0;
  margin-top: 35px;
  margin-left: 35px;
  border: solid transparent;
}
.mfp-arrow:after,
.mfp-arrow .mfp-a {
  border-top-width: 13px;
  border-bottom-width: 13px;
  top: 8px;
}
.mfp-arrow:before,
.mfp-arrow .mfp-a {
  border-top-width: 21px;
  border-bottom-width: 21px;
}
.mfp-arrow-left {
  left: 0;
}
.mfp-arrow-left:after,
.mfp-arrow-left .mfp-a {
  border-right: 17px solid #fff;
  margin-left: 31px;
}
.mfp-arrow-left:before,
.mfp-arrow-left .mfp-b {
  margin-left: 25px;
}
.mfp-arrow-right {
  right: 0;
}
.mfp-arrow-right:after,
.mfp-arrow-right .mfp-a {
  border-left: 17px solid #fff;
  margin-left: 39px;
}
.mfp-iframe-holder {
  padding-top: 40px;
  padding-bottom: 40px;
}
.mfp-iframe-holder .mfp-content {
  line-height: 0;
  width: 100%;
  max-width: 900px;
}
.mfp-iframe-scaler {
  width: 100%;
  height: 0;
  overflow: hidden;
  padding-top: 56.25%;
}
.mfp-iframe-scaler iframe {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-box-shadow: 0 0 8px rgba(0,0,0,0.4);
  box-shadow: 0 0 8px rgba(0,0,0,0.4);
  background: #000;
}
.mfp-iframe-holder .mfp-close {
  top: -40px;
}
img.mfp-img {
  width: auto;
  max-width: 100%;
  height: auto;
  display: block;
  line-height: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  padding: 40px 0 40px;
  margin: 0 auto;
}
.mfp-figure {
  line-height: 0;
}
.mfp-figure:after {
  content: '';
  position: absolute;
  left: 0;
  top: 40px;
  bottom: 40px;
  display: block;
  right: 0;
  width: auto;
  height: auto;
  z-index: -1;
  -webkit-box-shadow: 0 0 8px rgba(0,0,0,0.4);
  box-shadow: 0 0 8px rgba(0,0,0,0.4);
  background: #444;
}
.mfp-bottom-bar {
  margin-top: -36px;
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  cursor: auto;
}
.mfp-title {
  text-align: left;
  line-height: 18px;
  color: #f3f3f3;
  word-break: break-word;
  padding-right: 36px;
}
.mfp-figure small {
  color: #bdbdbd;
  display: block;
  font-size: 12px;
  line-height: 14px;
}
.mfp-image-holder .mfp-content {
  max-width: 100%;
}
.mfp-gallery .mfp-image-holder .mfp-figure {
  cursor: pointer;
}
.mfp-fade.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.15s ease-out;
  -moz-transition: all 0.15s ease-out;
  -o-transition: all 0.15s ease-out;
  -ms-transition: all 0.15s ease-out;
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-bg.mfp-ready {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-fade.mfp-bg.mfp-removing {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-fade.mfp-wrap .mfp-content {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.15s ease-out;
  -moz-transition: all 0.15s ease-out;
  -o-transition: all 0.15s ease-out;
  -ms-transition: all 0.15s ease-out;
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-in .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  -ms-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -o-transform: scale(0.8);
  -ms-transform: scale(0.8);
  transform: scale(0.8);
}
.mfp-zoom-in.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}
.mfp-zoom-in.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}
.mfp-zoom-in.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-zoom-in.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -o-transform: scale(0.8);
  -ms-transform: scale(0.8);
  transform: scale(0.8);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-in.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-newspaper .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  -ms-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  -webkit-transform: scale(0) rotate(500deg);
  -moz-transform: scale(0) rotate(500deg);
  -o-transform: scale(0) rotate(500deg);
  -ms-transform: scale(0) rotate(500deg);
  transform: scale(0) rotate(500deg);
}
.mfp-newspaper.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.5s;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -ms-transition: 0.5s;
  transition: 0.5s;
}
.mfp-newspaper.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1) rotate(0deg);
  -moz-transform: scale(1) rotate(0deg);
  -o-transform: scale(1) rotate(0deg);
  -ms-transform: scale(1) rotate(0deg);
  transform: scale(1) rotate(0deg);
}
.mfp-newspaper.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-newspaper.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(0) rotate(500deg);
  -moz-transform: scale(0) rotate(500deg);
  -o-transform: scale(0) rotate(500deg);
  -ms-transform: scale(0) rotate(500deg);
  transform: scale(0) rotate(500deg);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-newspaper.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-horizontal .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  -webkit-transform: translateX(-50px);
  -moz-transform: translateX(-50px);
  -o-transform: translateX(-50px);
  -ms-transform: translateX(-50px);
  transform: translateX(-50px);
}
.mfp-move-horizontal.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.mfp-move-horizontal.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  -o-transform: translateX(0);
  -ms-transform: translateX(0);
  transform: translateX(0);
}
.mfp-move-horizontal.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-move-horizontal.mfp-removing .mfp-with-anim {
  -webkit-transform: translateX(50px);
  -moz-transform: translateX(50px);
  -o-transform: translateX(50px);
  -ms-transform: translateX(50px);
  transform: translateX(50px);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-horizontal.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-from-top .mfp-content {
  vertical-align: top;
}
.mfp-move-from-top .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  -webkit-transform: translateY(-100px);
  -moz-transform: translateY(-100px);
  -o-transform: translateY(-100px);
  -ms-transform: translateY(-100px);
  transform: translateY(-100px);
}
.mfp-move-from-top.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
}
.mfp-move-from-top.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -o-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
}
.mfp-move-from-top.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-move-from-top.mfp-removing .mfp-with-anim {
  -webkit-transform: translateY(-50px);
  -moz-transform: translateY(-50px);
  -o-transform: translateY(-50px);
  -ms-transform: translateY(-50px);
  transform: translateY(-50px);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-move-from-top.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-3d-unfold .mfp-content {
  -webkit-perspective: 2000px;
  -moz-perspective: 2000px;
  -ms-perspective: 2000px;
  perspective: 2000px;
}
.mfp-3d-unfold .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-in-out;
  -moz-transition: 0.3s ease-in-out;
  -o-transition: 0.3s ease-in-out;
  -ms-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transform: rotateY(-60deg);
  -moz-transform: rotateY(-60deg);
  -o-transform: rotateY(-60deg);
  -ms-transform: rotateY(-60deg);
  transform: rotateY(-60deg);
}
.mfp-3d-unfold.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.5s;
  -moz-transition: 0.5s;
  -o-transition: 0.5s;
  -ms-transition: 0.5s;
  transition: 0.5s;
}
.mfp-3d-unfold.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -o-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.mfp-3d-unfold.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-3d-unfold.mfp-removing .mfp-with-anim {
  -webkit-transform: rotateY(60deg);
  -moz-transform: rotateY(60deg);
  -o-transform: rotateY(60deg);
  -ms-transform: rotateY(60deg);
  transform: rotateY(60deg);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-3d-unfold.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-out .mfp-with-anim {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-in-out;
  -moz-transition: 0.3s ease-in-out;
  -o-transition: 0.3s ease-in-out;
  -ms-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  -webkit-transform: scale(1.3);
  -moz-transform: scale(1.3);
  -o-transform: scale(1.3);
  -ms-transform: scale(1.3);
  transform: scale(1.3);
}
.mfp-zoom-out.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: 0.3s ease-out;
  -moz-transition: 0.3s ease-out;
  -o-transition: 0.3s ease-out;
  -ms-transition: 0.3s ease-out;
  transition: 0.3s ease-out;
}
.mfp-zoom-out.mfp-ready .mfp-with-anim {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}
.mfp-zoom-out.mfp-ready.mfp-bg {
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}
.mfp-zoom-out.mfp-removing .mfp-with-anim {
  -webkit-transform: scale(1.3);
  -moz-transform: scale(1.3);
  -o-transform: scale(1.3);
  -ms-transform: scale(1.3);
  transform: scale(1.3);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-zoom-out.mfp-removing.mfp-bg {
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.mfp-dialog {
  background: #fff;
  padding: 20px 30px;
  text-align: left;
  max-width: 400px;
  margin: 40px auto;
  position: relative;
}
.mfp-search-dialog {
  max-width: 800px;
}
.tweet-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.twitter .tweet-list li {
  margin-bottom: 15px;
  position: relative;
  padding-left: 25px;
}
.twitter .tweet-list li:before {
  content: '\f099';
  font-family: 'FontAwesome';
  position: absolute;
  top: 0;
  left: 0;
}
.twitter-ticker .tweet-list {
  height: 4.7em;
  overflow-y: hidden;
}
.twitter-ticker .tweet-list li {
  height: 4.7em;
  line-height: 16px;
}
.comments-list {
  margin: 0;
  padding: 0;
  list-style: none;
}
.comments-list ul {
  list-style: none;
}
.comments-list li ul {
  margin-left: 25px;
}
.comment {
  margin-bottom: 25px;
  overflow: hidden;
}
.comment .comment-review-rate {
  margin: 0;
  color: #ed8323;
  font-size: 13px;
}
.comment .comment-author {
  float: left;
  margin-right: 10px;
}
.comment .comment-author img {
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.comment .comment-inner {
  display: table;
}
.comment .comment-content {
  margin: 3px 0;
  padding-bottom: 10px;
  border-bottom: 1px dashed #e6e6e6;
}
.comment .comment-author-name {
  font-size: 12px;
  color: #888;
  margin: 0;
}
.comment .comment-time {
  font-size: 12px;
  margin-right: 10px;
  color: #8f8f8f;
}
.comment .comment-like {
  float: right;
  opacity: 0.3;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
  filter: alpha(opacity=30);
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  font-size: 12px;
  font-weight: bold;
}
.comment .comment-like [class^="fa fa-"] {
  font-weight: normal;
}
.comment .comment-reply {
[class^="fa fa-"]: 13px;
}
.comment:hover .comment-like {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.fontawesome-icon-list .fa-hover {
  margin-bottom: 10px;
}
.fontawesome-icon-list .fa-hover > a {
  color: #737373;
  font-size: 11px;
}
.fontawesome-icon-list .fa-hover > a .fa {
  color: #515151;
  width: 20px;
  text-align: center;
  margin-right: 7px;
  font-size: 14px;
  position: relative;
}
.demo-grid .row {
  margin-bottom: 20px;
}
.demo-grid .row [class^="col-"] > div {
  height: 20px;
  background: #999;
}
.demo-grid h5 {
  font-size: 14px;
  margin-bottom: 3px;
  color: #888;
}
.preview-area {
  text-align: center;
}
.preview-item {
  opacity: 0.85;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=85)";
  filter: alpha(opacity=85);
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.preview-item:hover {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.preview-item:hover .preview-img {
  -webkit-transform: translate(0, -5px) scale(1.05);
  -moz-transform: translate(0, -5px) scale(1.05);
  -o-transform: translate(0, -5px) scale(1.05);
  -ms-transform: translate(0, -5px) scale(1.05);
  transform: translate(0, -5px) scale(1.05);
}
.preview-img {
  display: block;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.preview-desc {
  color: #fff;
  margin: 10px 20px 20px 20px;
  font-size: 13px;
}
.preview-title {
  text-transform: uppercase;
  display: table;
  line-height: 1em;
  padding: 5px 7px;
  background: #ed8323;
  margin: 0 auto;
}
.preview-title > a {
  color: #fff;
}
.preview-logo {
  width: auto;
  display: inline-block;
  margin-top: 40px;
  margin-bottom: 10px;
}
.ri-grid {
  position: relative;
  height: auto;
  width: 100%;
}
.ri-grid ul {
  list-style: none;
  display: block;
  width: 100%;
  margin: 0;
  padding: 0;
  zoom: 1;
}
.ri-grid ul:before,
.ri-grid ul:after {
  content: '';
  display: table;
}
.ri-grid ul:after {
  clear: both;
}
.ri-grid ul li {
  -webkit-perspective: 400px;
  -moz-perspective: 400px;
  -ms-perspective: 400px;
  perspective: 400px;
  margin: 0;
  padding: 0;
  float: left;
  position: relative;
  display: block;
  overflow: hidden;
  -webkit-transition: opacity 0.5s;
  -moz-transition: opacity 0.5s;
  -o-transition: opacity 0.5s;
  -ms-transition: opacity 0.5s;
  transition: opacity 0.5s;
}
.ri-grid ul li:hover {
  opacity: 0.5;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
  filter: alpha(opacity=50);
}
.ri-grid ul li a {
  display: block;
  outline: none;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-background-size: 100% 100%;
  -moz-background-size: 100% 100%;
  background-size: 100% 100%;
  background-position: center center;
  background-repeat: no-repeat;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}

.details tr:nth-child(even) {
  background-color: #f2f2f4 !important;
}

.details td{
  padding: 15px !important;
  text-transform: uppercase;

}

.details thead tr th{
  padding: 15px !important;
  background-color: #a8a8a8 !important;
  color: white;
  text-transform: uppercase;
}

.strike {
  display: block;
  text-align: center;
  overflow: hidden;
  white-space: nowrap;
}

.strike > span {
  position: relative;
  display: inline-block;
}

.strike > span:before,
.strike > span:after {
  content: "";
  position: absolute;
  top: 50%;
  width: 9999px;
  height: 1px;
  background: #cccccc;
}

.strike > span:before {
  right: 100%;
  margin-right: 15px;
}

.strike > span:after {
  left: 100%;
  margin-left: 15px;
}
.tt-suggestions strong {
  font-weight: normal;
  color: #ed8323;
}
.tt-dropdown-menu .tt-suggestion.tt-cursor {

  background-color: #d6d6d6;
  color: white !important;
}


/*--- customize ----*/
.booking-filters {
  /*display: none;*/
}
.flight-details {
  width: 100%;
  /*border: 1px solid#e6e6e6;*/
  margin: 0 0 2%;
}
.flight-details th {
  padding: 2% 0%;
  text-transform: uppercase;
  width:16.666%;
}
.flight-details td {
  padding: 2% 0;
}
.flight-details h5 {
  font-size: 16px;
}
.flight-details p {
  font-size: 12px;
}
.flight-details .flight-popover span {
  text-decoration: underline;
  cursor: pointer;
}
.flight-details .flight-content {
  width: 100%;
}
.flight-details .flight-content h5 {
  font-size: 14px;
  font-weight: 500;
  margin: 0;
}
.flight-details .flight-content p {
  font-size: 12px;
  margin: 0;
}
.flight-details .flight-content .stop-over {
  margin: 15px 0px;
  color: #ed8323;
}
.popover {
  max-width: 800px !important;
  width: auto;
}
.flight-details .flight-content .popover-title {
  background-color: #ed8323 !important;
  border-bottom: 1px solid #e27513 !important;
}
.flight-content p{
  color: grey !important;
}
.flight-content h5{
  color: grey !important;
}
.flight-details tr:nth-child(odd) td{background: #eee}
.flight-details tr:nth-child(even) td{background: #FFF}
.booking-item-flight-details .booking-item-destination,
.booking-item-flight-details .booking-item-departure .booking-item-date, .booking-item-flight-details .booking-item-arrival .booking-item-date{
  margin:0;
}
.booking-item-flight-details .booking-item-departure .booking-item-date,
.booking-item-flight-details .booking-item-arrival .booking-item-date, .booking-item-flight-details .booking-item-destination {
  padding-left: 21px;
}
.booking-item-flight-details .booking-item-departure .fa-plane,
.booking-item-flight-details .booking-item-arrival .fa-plane {
  top: 0px;
  font-size: 1.5em;
}
.booking-item-flight-details .booking-item-departure h5, .booking-item-flight-details .booking-item-arrival h5 {
  font-size: 16px;
}
.booking-item-price {
  font-size: 25px;
  margin-right: 10px;
}
.booking-item-flight-details .booking-item-departure,
.booking-item-flight-details .booking-item-arrival {
  width:100%;
}
.booking-summary {
  border: 1px solid#ed8323;
  padding: 5%;
  border-radius: 3px;
}
.booking-summary h5{
  text-transform: uppercase;
  font-weight:400;
  font-size:1.5em;
  margin-bottom: 0;
  color: #ed8323;
}
.booking-summary h3 {
  text-align: right;
  font-weight: 400;
}
.booking-summary .total-back {
  background-image: url('https://booking.airasia.com/Content/Images/Select/price-itinerary-grating.png');
  background-repeat-y: no-repeat;
  background-repeat: repeat-x;
  height: 70px;
  position: relative;
}
.booking-summary .total-wrap {
  background: #fff;
  display: inline-block;
  float: right;
  margin-right: 8px;
  height: 56px;
  padding: 0 5px;
}
.booking-summary .total {
  text-align: right;
  text-transform: uppercase;
  margin: 0;
}
.booking-summary .total span {
  font-weight: bold;
}
.booking-summary .depart {
  background: #ed8323;
  border-radius: 2px;
  padding: 1% 0;
}
.booking-summary .depart .origin {
  width: 45%;
  display: inline-block;
  color: #fff;
  margin: 0;
  text-align: center;
}
.booking-summary .depart .destination {
  width: 50%;
  display: inline-block;
  color: #fff;
  text-align: center;
  margin: 0;
}
.booking-summary .fa-angle-right:before {
  color: #fff;
  font-size: 57px;
  position: absolute;
  margin-top: -34px;
}
.booking-summary .time .depart-time {
  font-size: 12px;
  display: inline;
}
.booking-summary .time .arrival-time {
  font-size: 12px;
  display: initial;
  float: right;
}
.booking-summary .passenger-details .text-left {
  text-align: left;
  float: left;
  font-size: 13px;
  margin: 0;
}
.booking-summary .passenger-details .text-right {
  text-align: right;
  font-size: 13px;
  margin: 0;
}
.booking-summary .passenger-details .total-text-right {
  text-align: right;
  font-weight: bold;
  margin-top: 1%;
}
.booking-summary h6 {
  font-size: 16px;
}
.booking-summary .passenger-details .fare-details {
  background: #eee;
  padding: 1% 3%;
  border-radius: 2px;
}
.booking-summary .btn-primary {
  background: #ed8323;
  border: 1px solid #e27513;
  margin-top: 20px;
  padding: 5%;
  text-align: center;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  -webkit-border-radius: 3px;
  border-radius: 3px;
}
.booking-summary .btn-primary:hover {
  background: #e27513;
  border-color: #ed8323;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  -webkit-border-radius: 10px;
  border-radius: 10px;
}
div.nav-drop {
  float: right;
  margin-top: 10px;
}
.departure-title {
  float: left;
}
.departure-title h4{
  font-weight: 400;
}
.departure-title span {
  font-size: 17px;
  margin: 0px 5px;
  position: absolute;
  font-weight: 300;
}
.booking-item-airline-logo > img {
  width: 85%;
}
.book-panel-container {
  position: fixed;
  width: 100%;
  bottom: 0px;
  border-top: 2px solid #f89406;
  background-color: white;
  z-index: 9999;
}
.flight-details tr.selected td{
  background-color: #ed8323;
  color: white;
}

.flight-details tr.selected td span{
  color: white;
}
.flight-details tr.selected td p{
  color: white;
}
.flight-details tr.selected td h5{
  color: white;
}

#btnGetHotelDetail{
  width: 100px;
  margin-top: 7px;
}

/*-----responsive-----*/
@media screen and (max-width: 1024px) {
  .booking-summary .time .depart-time {
    font-size:  10px;
  }
  .booking-summary h6 {
    font-size: 15px;
  }
  .booking-summary .passenger-details .text-right {
    font-size: 12px;
  }
  .booking-summary .passenger-details .text-left {
    font-size: 12px;
  }
  .booking-summary h5 {
    font-size: 1.4em;
  }
}

@media screen and (max-width: 992px) {
  .col-md-3{
    /*width: 22%;*/
  }

  .col-md-9{
    width: 78%;
  }
  .booking-filters{
    width:200px !important;
  }

  .booking-item .col-md-5 {
    width: 37.666667%;
  }

  #btnGetHotelDetail{
    width: auto !important;
    margin-top: 7px !important;
    margin-left: -25px !important;
  }
}
/*carousel*/
/* Feel free to change duration  */
.animated  {
  -webkit-animation-duration : 1000 ms  ;
  animation-duration : 1000 ms  ;
  -webkit-animation-fill-mode : both  ;
  animation-fill-mode : both  ;
}
/* .owl-animated-out - only for current item */
/* This is very important class. Use z-index if you want move Out item above In item */
.owl-animated-out {
  z-index : 1
}
/* .owl-animated-in - only for upcoming item
/* This is very important class. Use z-index if you want move In item above Out item */
.owl-animated-in {
  z-index : 0
}
/* .fadeOut is style taken from Animation.css and this is how it looks in owl.carousel.css:  */
.fadeOut  {
  -webkit-animation-name : fadeOut  ;
  animation-name : fadeOut  ;
}
@-webkit-keyframes  fadeOut  {
  0% {
    opacity : 1   ;
  }
  100% {
    opacity : 0   ;
  }
}
@keyframes  fadeOut  {
  0% {
    opacity : 1   ;
  }
  100% {
    opacity : 0   ;
  }
}
/** added by Rachelle**/
.btn-orange {
  background: #ed8323;
  color: #fff;
  padding: 8px 25px;
}
.btn-yellow {
  background: #f0be16;
  color: #fff;
  padding: 8px 25px;
}
#tours {
  overflow: hidden;
  margin-top: -5px;
}
.tour {
  margin-bottom: 20px;
  padding: 0;
}
.tour-container {
  overflow: hidden;
  background-color: #f0f5f8;
}
.tour:nth-child(odd) {
  padding-right: 10px;
  padding-top: 30px;
}
.tour:nth-child(even) {
  padding-left: 10px;
  padding-right: 10px;
  padding-top: 30px;
}
.tour:nth-child(3) .tour-detail,
.tour:nth-child(4) .tour-detail {
  float: left;
}
.tour:hover .tour-action {
  display: block!important;
}
.tour-img, .tour-detail {
  /*background: #f0f5f8;*/
}
.tour-hotel i {
  color: #fff;
  background: #f0be16;
  width: 30px;
  height: 30px;
  border-radius: 15px;
  font-size: 20px;
  text-align: center;
  padding: 5px;
}
.tour-detail {
  padding: 20px 35px;
  max-height: 242px;
}
.tour:hover .tour-detail {
  /*max-height: inherit;*/
}
.tour:hover .tour-detail .tour-description p {
  -webkit-line-clamp: 3;
}
.tour-detail::after {
  content: '';
}
.tour-title {
  color: #ed8323;
  min-height: 60px;
}
.tour-img {
  padding: 0;
}
.tour-description {
  font-size: 12px;
}
.tour-description p {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
}
.no-hidden-fees-tablet {
  display: none;
}
.no-hidden-fees, .no-hidden-fees-tablet {
  position: absolute;
  top: 0;
  right: 0;
}
.no-hidden-fees img,
.no-hidden-fees-tablet img {
  width: 90px;
}
.no-hidden-fees-icon {
  float: left;
  width: 70px;
  margin-right: 15px;
  padding-bottom: 30px;
}

#travel-tips {
  background: #f0f5f8;
  padding: 60px;
}
#why-choose-us {
  padding: 60px;
  overflow: hidden;
}
.section-title {
  text-align: center;
  font-weight: 600;
}
.section-hr {
  width: 10%;
  border: 2px solid orange;
  margin: 10px auto;
}
.sub-title {
  font-weight: 600;
  padding: 20px 0;
}
.testimony-img img {
  width: 70px;
  height: 70px;
  border-radius: 41px;
}
.footer-hr {
  clear: both;
}
.footer-hr-orange {
  width: 20%;
  float: left;
  border-color: #e27f25;
  position: absolute;
  top: 30px;
}
.center {
  text-align: center;
}
.section-caption {
  margin-top: 40px;
}
.section-content {
  margin-top: 5%;
}
.title {
  color: #ed8323;
  font-weight: 600;
}
.thumbnail {
  border-radius: 0;
  border: 0;
  padding: 0;
  padding-bottom: 20px;
}
.thumbnail .caption {
  padding: 15px 20px;
}
.section {
  overflow: hidden;
}
#about-us, #testimonials {
  min-height: 470px;
  float: left;
  padding: 50px;
}
#about-us {
  width: 40%;
  background-image: url('../img/background-about-us.png');
  background-color: #e67f21;
}
#testimonials {
  width: 60%;
}
#about-us h3,
#about-us h4 {
  color: #fff;
  font-weight: 600;
}
#testimonials h2 {
  color: #3e3b3b;
  font-weight: 600;
}
.testimony {
  padding: 0;
}
.section-content {
  margin: 30px 0
}
.sub-heading {
  font-size: 12px;
}
#featured-destinations {
  /*background: #f0f5f8;*/
  padding: 0 0 60px 0;
}
/*footer*/
.social-media-icons li > a {
  /*color: #262626!important;*/
  font-size: 15px;
}
.list-footer > li {
  padding: 5px 0;
}
.newsletter, .list-footer li h5 {
  color: #9c9a9a!important;
  font-size: 13px;
}
.copyrights {
  font-size: 12px!important;
  color: #837e7e;
}
.footer-thumbnail {
  width: 33%;
  height: 100px;
  border: 1px dashed #eee;
}
/*carousel*/
.owl-carousel {
  padding: 0;
}

.owl-prev, .owl-next
  /*, .carousel-control*/ {
  width: 30px;
  height: 30px;
  border-radius: 15px;
  background: #ed8323;
  padding: 3px 0;
  font-size: 1.5em;
  margin-top: 5%;
  background-image: none!important;
  opacity: 1;
}

.owl-controls .owl-buttons div {
  width: 35px;
  height: 35px;
  font-size: 25px;
  background: #ed8323;
}
#carousel-international .owl-pagination,
#carousel-domestic .owl-pagination {
  display: none;
}
.arrow {
  border-top: 25px solid transparent;
  border-right: 25px solid #f0f5f8;
  border-bottom: 25px solid transparent;
  position: absolute;
  left: -25px;
  top: 120px;
}
.arrow-left {
  border-top: 25px solid transparent;
  border-right: 25px solid #f0f5f8;
  border-bottom: 25px solid transparent;
  position: absolute;
  left: -25px;
  top: 100px;
  z-index: 9;
}
#testimonials .carousel-indicators {
  left: 40px;
  bottom: -70px;
}
#testimonials .carousel-indicators li {
  background: #c0c0c0;
}
#testimonials .carousel-indicators .active {
  background-color: #ffa200;
  box-shadow: 0px 0px 5px #ffa200;
  padding: 6px;
}

/*login*/
.login {
  background: #ed8323;
  color: #fff;
  padding: 20px;
}
.login h3 {
  color: #fff;
}
.mobile {
  display: none!important;
}
.search-tabs .tab-pane input,
.search-tabs .tab-pane button,
.search-tabs .tab-pane select {
  height: 45px;
  padding: 10px 18px;
}
.arrow-up {
  background: #ed8323;
  width: 40px;
  height: 40px;
  text-align: center;
  padding: 8px 10px;
  position: fixed;
  right: 20px;
  bottom: 10px;
  font-size: 22px;
  border-radius: 2px;
  z-index: 1;
}
.item img {
  /*border-radius: 8px;*/
}
#featured-destinations .owl-controls .owl-buttons div.owl-next {
  right: calc(50% - 15px);
  background: #fff;
  color: #000;
  box-shadow: 0px 0px 1px #555;
}
#featured-destinations .item-img {
  padding: 0;
  border-right: 1px solid #eee;
}
#featured-destinations .item {
  overflow: hidden;
  border: 1px solid #eee;
}
.caption, .featured-desc {
  padding: 15px;
  color: #000;
  font-size: 12px;
}
.caption h5, .featured-desc h5 {
  font-weight: 600;
}
.fd-location {
  margin-top: -18px;
}
#featured-destinations .owl-controls .owl-buttons div {
  top: 25%;
}
#featured-destinations .featured-desc ul {
  padding-left: 20px;
}
.overlay {
  display: none;
  position: absolute;
  height: calc(100vh + 88px);
  width: 100%;
  background: #000;
  top: 0;
  opacity: .2;
}
.hotel-title {
  color: #ed8323;
  font-weight: 900;
  margin: 0;
}
.hotel-description {
  font-size: 12px;
  padding-top: 8px;
}
.hotel-description p {
  overflow: hidden;
  display: -webkit-box;
  /*-webkit-line-clamp: 5;*/
  -webkit-box-orient: vertical;
}
.tour:hover .hotel-description p {
  /*-webkit-line-clamp: 3;*/
}
.currency {
  font-weight: 900;
  font-size: 1.5em;
}
.currency sup {
  font-size: 10px;
}
.hotel-location {
  font-size: .6em;
  color: #888;
}
.hotel-subtitle {
  font-size: 1.3em;
  color: #ed8323;
  font-weight: 500;
  margin-top: -5px;
}
.hotel-action {
  text-align: center;
  margin-top: 15px;
  /*display: none;*/
}
.tour:hover .hotel-action {
  display: block;
}
.btn-orange a {
  color: #fff!important;
}
#tips {
  background: #f0f5f8;
  overflow: hidden;
  padding: 50px 20px;
}
.tips-title {
  color: #ed8323;
  font-weight: 400;
}
.tips-content {
  padding: 30px 10px;
}
.tips-content h5,
.tips-content h6,
.tips-content h4 {
  font-weight: 600;
  color: #000;
}
.tips-content ol li {
  padding: 10px 0;
}

/*mobile banner slider*/
#banner-slider {
  height: 100vh;
  width: 100%;
  overflow: hidden;
  display: none;
}
.footer-bottom {
  padding: 20px 0;
}
.testimony-img {
  padding: 5px;
}
.carousel-caption {
  text-align: left;
}
.carousel-caption h2 {
  color: #fff;
}
.featured-desc a {
  color: #000;
}
.testimony-img {
  display: none;
}
.overlay-text {
  position: absolute;
  top: 14%;
  right: 0;
  text-align: right;
  padding: 20px 50px;
  background: rgba(0,0,0,.4);
  border: none;
}
.overlay-text .row {
  /*padding: 15px 0;*/
}
.overlay-text h2 {
  color: #fff;
  margin: 0;
}
.overlay-text h4 {
  color: #fff;
  font-size: 1.2em;
}
.tour-img img {
  height: 280px;
}
.featured-section {
  padding: 60px 0;
  background-color: #f0f5f8;
}
#faq {
  padding-top: 50px;
  padding-bottom: 50px;
}
#faq a, #faq a:focus, #faq a:hover {
  text-decoration: none;
}
#faq .panel-title > .accordion-toggle.collapsed:before {
  font-family: 'FontAwesome';
  content: '+';
  font-size: 1.5em;
  padding-right: 5px;
  left: 0;
  top: 0;
  position: inherit;
}
#faq .panel-title > .accordion-toggle:before {
  font-family: FontAwesome;
  content: "â€“";
  font-size: 1.5em;
  padding-right: 5px;
  left: 0;
  top: 0;
  position: inherit;
}
#faq .panel-title > .accordion-toggle.close-toggle:before {
  font-family: 'FontAwesome';
  content: '+';
  font-size: 1.5em;
  padding-right: 5px;
  left: 0;
  top: 0;
  position: inherit;
}

#faq .panel-body {
  background-color: rgba(0,0,0,.05);
}
#faq .section-content {
  margin-top: 60px;
}
.bg-gray {
  background-color: #f0f5f8;
}
.wcu {
  padding-top: 15px;
  padding-bottom: 15px;
}
.panel-body * {
  line-height: 1.8em;
}

.icon-group {
  list-style: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}
.icon-group > li {
  float: left;
  margin-right: 5px;
}
.icon-group > li:last-child {
  margin-right: 0;
}

.searchHotelImage{
    height: 188px;
    width: 250px;
    border-radius: 5px;
}

.booking-list {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}

.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-title,
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: left;
  margin: 0;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount {
  float: right;
}
.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li .booking-item-payment-price-amount > small {
  margin-left: 3px;
}
.booking-item-details .booking-item-header {
  margin-bottom: 20px;
  margin-top: 15px;
  padding-top: 15px;
  border-top: 1px solid #f2f2f2;
}
.booking-item-details .booking-item-header-price {
  font-size: 19px;
  text-align: right;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price .text-lg {
  font-size: 42px;
  line-height: 1em;
}
.booking-item-details .booking-item-header-price small {
  font-size: 13px;
}
.booking-details-tabbable .nav > li > a > .fa {
  margin-right: 5px;
  opacity: 0.6;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
  filter: alpha(opacity=60);
  font-size: 13px;
  position: relative;
  top: -1px;
}
.booking-details-tabbable .nav > li.active > a > .fa {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.booking-list-wishlist > li {
  padding-top: 30px;
  padding-right: 25px;
}
.booking-list-wishlist > li .booking-item-wishlist-title {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  border: 1px solid #f2f2f2;
  background: #f7f7f7;
  border-bottom: none;
  font-size: 12px;
  -webkit-border-radius: 3px 3px 0 0;
  border-radius: 3px 3px 0 0;
}
.booking-list-wishlist > li .booking-item-wishlist-title > span {
  font-size: 9px;
  color: #8f8f8f;
  margin-left: 5px;
}
.booking-list-wishlist > li .booking-item-wishlist-remove {
  position: absolute;
  top: 30px;
  right: 0;
  display: block;
  width: 25px;
  height: 25px;
  line-height: 25px;
  background: #e6e6e6;
  color: #737373;
  text-align: center;
  -webkit-transition: 0.1s;
  -moz-transition: 0.1s;
  -o-transition: 0.1s;
  -ms-transition: 0.1s;
  transition: 0.1s;
}
.booking-list-wishlist > li .booking-item-wishlist-remove:hover {
  background: #4d4d4d;
  color: #fff;
}
.user-profile-sidebar {
  -webkit-border-radius: 5px;
  border-radius: 5px;
  margin-right: 30px;
  padding: 20px 0;
  background: #4d4d4d;
  color: #fff;
  margin-bottom: 30px;
}
.user-profile-sidebar .user-profile-avatar {
  padding: 0 20px;
  margin-bottom: 20px;
}
.user-profile-sidebar .user-profile-avatar img {
  max-width: 120px;
  margin-bottom: 15px;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.user-profile-sidebar .user-profile-avatar h5 {
  color: #fff;
  margin-bottom: 0;
  font-size: 16px;
}
.user-profile-sidebar .user-profile-avatar p {
  font-size: 10px;
}
.user-profile-sidebar .user-profile-nav > li {
  border-bottom: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li:first-child {
  border-top: 1px solid #404040;
}
.user-profile-sidebar .user-profile-nav > li.active > a {
  background: #ed8323;
  color: #fff;
  cursor: default;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover {
  background: #ed8323;
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li.active > a:hover > i {
  color: #fff;
}
.user-profile-sidebar .user-profile-nav > li > a {
  padding: 10px 20px;
  color: #d9d9d9;
  display: block;
  font-size: 13px;
}
.user-profile-sidebar .user-profile-nav > li > a:hover {
  color: #fff;
  background: #404040;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.user-profile-sidebar .user-profile-nav > li > a:hover > i {
  color: #ed8323;
}

.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price {
    margin: 0;
    padding: 0;
    list-style: none;
}

.booking-item-payment .booking-item-payment-details > li .booking-item-payment-price > li {
    width: 70%;
    overflow: hidden;
    font-size: 12px;
    border-bottom: 1px dashed #d9d9d9;
}

</style>

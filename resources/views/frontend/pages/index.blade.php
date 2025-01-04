@extends('frontend.layouts.app')

@push('css')
    <style>
        /* Color Variables */
        :root {
            --primary-color: #8a2be2;     /* Main purple */
            --secondary-color: #ff1493;    /* Deep pink */
            --gradient-start: #e7b3f3;     /* Light purple */
            --gradient-end: #8a4fff;       /* Medium purple */
            --text-dark: #333333;
            --text-light: #ffffff;
            --background-light: #ffffff;
            --title-size: 28px;
            --text-size: 23px;
            --text-size-small: 20px;
            --highlight-color: #ff69b4;
            --success-gradient: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            --shine-gradient: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
        }

        .text-red {
            color: red ;
        }
        /* Main Container */
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--background-light);
            font-size: var(--text-size);
            padding: 0;
            overflow: hidden;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(
                180deg,
                var(--background-light) 0%,
                var(--gradient-start) 50%,
                var(--gradient-end) 100%
            );
            padding: 35px 20px 45px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Create decorative elements */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: radial-gradient(
                circle at 50% 50%,
                rgba(255, 255, 255, 0.8) 0%,
                rgba(255, 255, 255, 0) 70%
            );
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: -5%;
            width: 110%;
            height: 50px;
            background: var(--background-light);
            border-radius: 50% 50% 0 0;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            color: var(--text-dark);
            font-size: calc(var(--title-size) + 2px);
            line-height: 1.6;
            margin: 0 auto 20px;
            padding: 25px 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow:
                0 4px 25px rgba(138, 43, 226, 0.15),
                0 2px 8px rgba(138, 43, 226, 0.1),
                inset 0 1px 1px rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.7);
            position: relative;
            max-width: 95%;
            transform: translateZ(0);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Add subtle gradient animation to hero background */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .hero-section {
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
        }

        /* Add responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 25px 15px 35px;
            }

            .hero-title {
                font-size: var(--title-size);
                padding: 20px 25px;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 7px 10px 38px;
            }

            .hero-title {
                padding: 15px 20px;
                font-size: calc(var(--title-size) - 2px);
            }
        }

        /* Video Section */
        .video-section {
            padding: 15px;
            background: var(--background-light);
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Discount Banner */
        .discount-banner {
            background: var(--secondary-color);
            color: var(--text-light);
            padding: 12px 25px;
            border-radius: 30px;
            display: inline-block;
            margin: 0 auto;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: auto;
            max-width: 90%;
        }

        /* CTA Button */
        .cta-button {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: var(--text-light);
            padding: 15px 35px;
            border-radius: 30px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            margin: 15px 0;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            color: var(--text-light);
        }

        /* Action Section */
        .action-section {
            text-align: center;
            padding: 5px 0;
            margin-top: 0;
        }

        /* Hero Subtitle */
        .hero-subtitle {
            color: var(--text-dark);
            line-height: 1.6;
            padding: 0 20px;
            margin: 0;
            text-align: center;
        }

        /* FAQ Section */
        .faq-section {
            margin: 20px 0;
        }

        .faq-section .accordion-item {
            border: none;
            background: transparent;
            margin-bottom: 10px;
        }

        .faq-section .accordion-button {
            background: linear-gradient(135deg, #e7b3f3 0%, #8a4fff 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 20px;
            font-size: var(--text-size);
            font-weight: 500;
        }

        .faq-section .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #8a4fff 0%, #e7b3f3 100%);
            color: white;
            box-shadow: none;
        }

        .faq-section .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .faq-section .accordion-body {
            background: white;
            border-radius: 0 0 8px 8px;
            padding: 20px;
            margin-top: -1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: var(--text-size-small);
        }

        .additional-faq {
            background: #ff69b4;
            padding: 15px;
            margin: 20px 0;
        }

        /* Benefits Section */
        .benefits-section {
            background: #ff69b4;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .benefits-title {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: var(--title-size);
        }

        .benefits-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefits-list li {
            color: white;
            padding: 10px 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .benefits-list li:before {
            content: "✓";
            margin-right: 10px;
            font-weight: bold;
        }

        /* Form Styles */
        .order-form {
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);  /* New vibrant gradient */
            padding: 25px 20px;
            margin: 25px 15px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .order-form h3 {
            color: var(--text-light);
            font-size: var(--title-size);
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-inner {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            padding: 25px;
            box-shadow:
                0 4px 6px rgba(0, 0, 0, 0.05),
                0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: var(--text-size-small);
            font-weight: 500;
        }

        .form-label .text-danger {
            color: #dc3545;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(138, 43, 226, 0.2);
            border-radius: 10px;
            font-size: var(--text-size-small);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            outline: none;
            border-color: #FF416C;
            box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* Error state */
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px 16px;
            padding-right: 40px;
        }

        .text-danger {
            display: block;
            margin-top: 5px;
            font-size: calc(var(--text-size-small) - 2px);
            color: #dc3545;
        }

        /* Alert styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid transparent;
        }

        .alert-danger {
            background-color: #fff5f5;
            border-color: #dc3545;
            color: #dc3545;
        }

        .alert a {
            color: inherit;
            text-decoration: underline;
            font-weight: 500;
        }

        /* Submit Button */
        .order-form .cta-button {
            width: 100%;
            margin-top: 15px;
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: var(--text-size);
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .order-form .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
        }

        /* Loading spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .order-form {
                margin: 20px 10px;
                padding: 20px 15px;
            }

            .form-inner {
                padding: 15px;
            }

            .form-control {
                padding: 10px 12px;
            }

            .form-label {
                font-size: calc(var(--text-size-small) - 1px);
            }
        }

        /* Product Selection Styles */
        .product-selection {
            margin: 25px 15px;
            padding: 25px 20px;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .product-selection h3 {
            color: var(--text-light);
            font-size: var(--title-size);
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-option {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow:
                0 4px 6px rgba(0, 0, 0, 0.05),
                0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .product-option:hover {
            transform: translateY(-2px);
            box-shadow:
                0 6px 12px rgba(0, 0, 0, 0.1),
                0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .product-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .product-details {
            display: flex;
            align-items: center;
            padding: 15px;
            cursor: pointer;
            width: 100%;
            position: relative;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            flex: 1;
        }

        .product-title {
            font-size: var(--text-size);
            color: var(--text-dark);
            margin-bottom: 8px;
            font-weight: 500;
            line-height: 1.4;
        }

        .product-price {
            font-size: var(--text-size);
            color: var(--secondary-color);
            font-weight: bold;
        }

        /* Selected state styling */
        .product-radio:checked + .product-details {
            background: rgba(138, 43, 226, 0.05);
        }

        .product-radio:checked + .product-details::before {
            content: '✓';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(138, 43, 226, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .product-selection {
                margin: 20px 10px;
                padding: 20px 15px;
            }

            .product-image {
                width: 80px;
                height: 80px;
                margin-right: 15px;
            }

            .product-title {
                font-size: var(--text-size-small);
            }

            .product-price {
                font-size: var(--text-size-small);
            }
        }

        /* Order Summary Styles */
        .order-summary {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            padding: 25px 20px;
            margin: 25px 15px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .order-summary h3 {
            color: var(--text-light);
            font-size: var(--title-size);
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary-item {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 12px;
            margin-bottom: 10px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .summary-item:last-child {
            margin-bottom: 0;
        }

        .summary-item span:first-child {
            color: var(--text-dark);
            font-size: var(--text-size-small);
        }

        .summary-item span:last-child {
            font-weight: 500;
            color: var(--primary-color);
            font-size: var(--text-size-small);
        }

        .summary-item.selected-product {
            background: rgba(255, 255, 255, 0.98);
            border-left: 4px solid var(--primary-color);
        }

        .summary-item.shipping-cost {
            background: rgba(255, 255, 255, 0.95);
            border-left: 4px solid var(--secondary-color);
        }

        .summary-total {
            margin-top: 15px;
            background: var(--text-light);
            border-radius: 12px;
            padding: 18px 20px;
            font-weight: bold;
            border: 2px solid rgba(255, 20, 147, 0.3);
            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.08),
                0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary-total span:first-child {
            color: var(--text-dark);
            font-size: var(--text-size);
        }

        .summary-total span:last-child {
            color: var(--secondary-color);
            font-size: var(--text-size);
            font-weight: 800;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .order-summary {
                margin: 20px 10px;
                padding: 20px 15px;
            }

            .summary-item {
                padding: 12px 15px;
            }

            .summary-item span:first-child,
            .summary-item span:last-child {
                font-size: calc(var(--text-size-small) - 2px);
            }

            .summary-total span:first-child,
            .summary-total span:last-child {
                font-size: var(--text-size-small);
            }
        }

        /* Offer Section Styles */
        .offer-wrapper {
            padding: 5px 15px;
            margin: 10px 0 5px;
        }

        .discount-banner-container {
            text-align: center;
            position: relative;
        }

        .discount-banner {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--highlight-color) 100%);
            color: var(--text-light);
            padding: 12px 25px;
            border-radius: 30px;
            display: inline-block;
            font-weight: bold;
            font-size: var(--text-size);
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            animation: pulse 2s infinite;
        }

        .discount-highlight {
            font-weight: 800;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .discount-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: var(--shine-gradient);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        /* Action Section Styles */
        .cta-wrapper {
            padding: 5px;
            text-align: center;
        }

        .cta-button {
            background: var(--success-gradient);
            padding: 18px 40px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .cta-text {
            font-size: var(--text-size);
            font-weight: bold;
        }

        .cta-arrow {
            font-size: 24px;
            transition: transform 0.3s ease;
        }

        .cta-button:hover .cta-arrow {
            transform: translateX(5px);
        }

        /* Info Section Styles */
        .info-section {
            padding: 15px;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border-radius: 15px;
            margin: 20px 15px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 12px;
            padding: 20px;
            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.08),
                0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .hero-subtitle {
            margin: 0;
            padding: 0;
            font-size: var(--text-size);
            line-height: 1.8;
            color: var(--text-dark);
            position: relative;
        }

        /* Add subtle highlight to important text without changing content */
        .hero-subtitle strong {
            color: var(--primary-color);
            font-weight: bold;
        }

        .highlight-text {
            color: var(--primary-color);
            font-weight: bold;
        }

        .emphasis-text {
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-100%); }
            100% { transform: rotate(45deg) translateX(100%); }
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .discount-banner {
                font-size: var(--text-size-);
                padding: 12px 25px;
            }

            .cta-button {
                padding: 15px 30px;
            }

            .hero-subtitle {
                font-size: var(--text-size-small);
                padding: 15px;
            }
        }

        /* Shipping Selection Styles */
        .shipping-selection {
            background: linear-gradient(135deg, #20bf55 0%, #01baef 100%);  /* Unique gradient */
            padding: 25px 20px;
            margin: 25px 15px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .shipping-selection h3 {
            color: var(--text-light);
            font-size: var(--title-size);
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .shipping-option {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .shipping-option:last-child {
            margin-bottom: 0;
        }

        .shipping-option:hover {
            transform: translateY(-2px);
            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.1),
                0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .shipping-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .shipping-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            cursor: pointer;
            position: relative;
        }

        .shipping-info {
            color: var(--text-dark);
            font-size: var(--text-size-small);
            font-weight: 500;
        }

        .shipping-price {
            color: #20bf55;  /* Match gradient color */
            font-size: var(--text-size-small);
            font-weight: bold;
        }

        /* Selected state styling */
        .shipping-radio:checked + .shipping-details {
            background: rgba(32, 191, 85, 0.05);  /* Light green background */
        }

        .shipping-radio:checked + .shipping-details::before {
            content: '✓';
            position: absolute;
            left: -25px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            background: #20bf55;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(32, 191, 85, 0.3);
            animation: slideIn 0.3s ease forwards;
        }

        @keyframes slideIn {
            from {
                left: -25px;
                opacity: 0;
            }
            to {
                left: 15px;
                opacity: 1;
            }
        }

        /* Hover effect */
        .shipping-option:hover .shipping-details {
            background: rgba(32, 191, 85, 0.02);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .shipping-selection {
                margin: 20px 10px;
                padding: 20px 15px;
            }

            .shipping-details {
                padding: 12px 15px;
            }

            .shipping-info,
            .shipping-price {
                font-size: calc(var(--text-size-small) - 2px);
            }
        }
    </style>
@endpush

@section('page_content')
    <div class="main-container">
        @php
            $product = $products->first();
            $shipping = $shippings->first();
        @endphp

        <!-- header Section -->
        <div class="hero-section">
            <h1 class="hero-title fw-bolder">কনকনে শীতে সন্তানের আরাম ও স্বাস্থ্য সুরক্ষায় ডাবল স্টিজ  ওয়াশেবল ডায়পার একমাত্র সমাধান।</h1>
        </div>

        <!-- Video Section -->
        <div class="video-section">
            <div class="video-container">
                <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/92jIukxdaBo?si=rUoNhgimyuMfYyPL&autoplay=1"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
            ></iframe>
            </div>
        </div>

        <!-- Offer Section -->
        <div class="offer-wrapper">
            <div class="discount-banner-container">
                <div class="discount-banner">
                    প্রথমবার অর্ডার করলে পাচ্ছেন <span class="discount-highlight"> ২০% ছাড়</span> এবং এক্সট্রা প্যাড ফ্রি
                    <div class="discount-shine"></div>
                </div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="action-section">
            <div class="cta-wrapper">
                <a href="#product_selection" class="cta-button">
                    <span class="cta-text">অর্ডার করতে ক্লিক করুন</span>
                    <span class="cta-arrow">→</span>
                </a>
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-card">
                <p class="hero-subtitle">
                    <span class="highlight-text">আপনার সোনামণির জন্য সেরা যত্ন</span>, এখন হাতের নাগালে। সাশ্রয়ী মূল্যে উন্নত মানের ওয়াশেবল ডায়াপার কিনুন এখনই!
                    <br><br>
                    <span class="emphasis-text">নিরাপদ, আরামদায়ক ও পরিবেশবান্ধব</span>, যা আপনার শিশুর কোমল ত্বকের জন্য একদম আদর্শ
                </p>
            </div>
        </div>

        <!-- Main FAQ Section -->
        <div class="faq-section additional-faq">
            <div class="accordion" id="mainFaqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                           প্লাস্টিক ডায়াপার কি আপনার শিশুর আরাম কেড়ে নিচ্ছে?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            আপনার শিশুর কোমল ত্বকে প্লাস্টিক ডায়াপারের কারণে হতে পারে লালচে দাগ, র‍্যাশ এবং ত্বকের জ্বালাপোড়া। লিকেজ ও বারবার কেনার খরচ তো আছেই।
                            <br> <br>
                            সমাধান? <br>
                            আমাদের ওয়াশেবল ডায়াপার। <br>
                            ➡️ নরম, আরামদায়ক এবং ত্বক-বান্ধব। <br>
                            ➡️ লিকেজমুক্ত এবং বারবার ব্যবহারযোগ্য।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            কেন আমাদের ওয়াশেবল ডায়াপার সেরা?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            আমাদের ওয়াশেবল ডায়াপার তৈরি করা হয়েছে উন্নত মানের নরম ফেব্রিক দিয়ে, যা আপনার শিশুর কোমল ত্বকের জন্য একদম উপযোগী।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            আমাদের নতুন প্রজন্মের সেরা ডায়াপার: লিকেজ? আর নয়!
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            <b>ডাবল লেয়ার সিস্টেম:</b> নিশ্চিত লিকেজমুক্ত সুরক্ষা। <br> <br>

                            <b>ডাবল সেলাই:</b> পেশাব লিক হওয়ার ঝুঁকি সম্পূর্ণ দূর।<br>
                            পুরো ডায়াপার বদলানোর ঝামেলা নেই, শুধু প্যাড বদলালেই হলো! <br> <br>

                           <b> কাস্টমাইজড বাটন:</b> আপনার শিশুর মাপ অনুযায়ী সহজেই সেট করুন।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4  -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            এটা কি সব বয়সের শিশুদের জন্য উপযোগী?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            হ্যাঁ! এটি বিশেষভাবে ০-৩ বছর বয়সের শিশুদের জন্য নিখুঁতভাবে মানানসই।
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            কতদিন ব্যবহার করা যাবে?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                        <div class="accordion-body">
                            সঠিক যত্ন নিলে, আমাদের পণ্যগুলো আপনাকে ৬ থেকে ১২ মাস পর্যন্ত সন্তুষ্টি দিতে পারবে।
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <!-- Benefits Section -->
        {{-- <div class="benefits-section">
            <h3 class="benefits-title">শুধু ডায়াপার নয়, এটি একটি বিনিয়োগ:</h3>
            <ul class="benefits-list">
                <li>সাশ্রয়ী: বারবার ব্যবহারের মাধ্যমে খরচ কমায়।</li>
                <li>পরিবেশবান্ধব: রাষ্ট্রিক খরচা কমায়।</li>
                <li>স্বাস্থ্যকর: শিশুর ত্বকে কোনো ক্ষতিকারক রাসায়নিক নেই।</li>
                <li>সহজ পরিচর্যা: মাত্র কয়েক ধাপেই ধুয়ে পুনরায় ব্যবহার করুন।</li>
                <li>দীর্ঘস্থায়ী: একবার কিনলে মাসের পর মাস ব্যবহার করুন।</li>
            </ul>
        </div> --}}

        <!-- Order Form -->
        <form action="{{route('order.store')}}" method="POST" id="orderForm">
            @csrf

            <!-- Product Selection -->
            @if($products->count() > 0)
                <div class="product-selection" id="product_selection">
                    <h3>পণ্য নির্বাচন করুন</h3>
                    @foreach($products as $product)
                        <div class="product-option">
                            <input
                                type="radio"
                                name="slug"
                                id="product{{ $product->id }}"
                                value="{{ $product->slug }}"
                                class="product-radio"
                                {{ $loop->first ? 'checked' : '' }}
                            >
                            <label for="product{{ $product->id }}" class="product-details">
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->title }}" class="product-image">
                                <div class="product-info">
                                    <div class="product-title">{{ $product->title }}</div>
                                    <div class="product-price">৳{{ number_format($product->price, 2) }}</div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Shipping Selection -->
            @if($shippings->count() > 0)
                <div class="shipping-selection">
                    <h3>ডেলিভারি চার্জ নির্বাচন করুন</h3>
                    @foreach($shippings as $shipping)
                        <div class="shipping-option">
                            <input
                                type="radio"
                                name="shipping_id"
                                id="shipping{{ $shipping->id }}"
                                value="{{ $shipping->id }}"
                                class="shipping-radio"
                                {{ $loop->first ? 'checked' : '' }}
                            >
                            <label for="shipping{{ $shipping->id }}" class="shipping-details">
                                <div class="shipping-info">{{ $shipping->type }}</div>
                                <div class="shipping-price">৳{{ number_format($shipping->price, 2) }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif


            <!-- Order Summary -->
            <div class="order-summary">
                <h3>অর্ডার সামারি</h3>
                <div class="summary-item selected-product">
                    <span>Selected Product:</span>
                    <span id="selectedProductName">{{ $product ? $product->title : '' }}</span>
                </div>
                <div class="summary-item">
                    <span>সাবটোটাল:</span>
                    <span id="subtotal">৳{{ number_format($product ? $product->price : 0, 2) }}</span>
                </div>
                <div class="summary-item shipping-cost">
                    <span>শিপিং:</span>
                    <span id="shipping-cost">{{ $shipping ? '৳ ' . number_format($shipping->price, 2) : 'Free' }}</span>
                </div>
                <div class="summary-item summary-total">
                    <span>টোটাল:</span>
                    <span id="total">৳{{ number_format(($product ? $product->price : 0) + ($shipping ? $shipping->price : 0), 2) }}</span>
                </div>
            </div>

            <!-- Order Form -->
            <div class="order-form" id='order_detials'>
                <h3>অর্ডার করতে নিচের ফরমটি পূরণ করুন</h3>
                <div class="form-inner">
                    @if(session('success'))
                        <div class="alert alert-danger">
                            আপনি ইতিপূর্বেই {{ session('success') }} নাম্বার দিয়ে অর্ডার সম্পূর্ণ করেছেন।
                            অর্ডার সম্পর্কে বিস্তারিত জানতে - <br>
                            Call: <a href="tel:{{$site_contact_info->phone}}"> {{$site_contact_info->phone}}</a> <br>
                            Whatsapp: <a href="https://wa.me/{{$site_contact_info->whatsapp}}"> {{$site_contact_info->whatsapp}}</a>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label" for="name">আপনার নাম <span class="text-red">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">মোবাইল নাম্বার <span class="text-red">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">সম্পূর্ণ ঠিকানা <span class="text-red">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required></textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="note">আপনার মতামত এখানে লিখুন</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note"></textarea>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" id="productName" name="productName" value="{{ $product ? $product->title : '' }}">
                    <input type="hidden" id="productPrice" name="productPrice" value="{{ $product ? $product->price : 0 }}">
                    <input type="hidden" id="shippingCost" name="shippingCost" value="{{ $shipping ? $shipping->price : 0 }}">

                    <button type="submit" class="cta-button">
                        <span class="button-text">অর্ডার কনফার্ম করুন</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('custom-js')
<script>
    $(document).ready(function() {
        const iframe = $('.video-container iframe');
        // Wait for any user interaction
        $(document).one('click', function() {
            if (iframe.length) {
                let currentSrc = iframe.attr('src');
                iframe.attr('src', currentSrc + '&autoplay=1');
            }
        });

        // Smooth scroll for anchor links
        $('a[href^="#product_selection"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.hash);
            $('html, body').scrollTop(target.offset().top - 20);
        });

        // Form submission handling
        $('#orderForm').on('submit', function(e) {
            const submitButton = $(this).find('button[type="submit"]');

            // If the button is already disabled, stop here
            if (submitButton.prop('disabled')) {
                return false;
            }

            const name = $('#name').val();
            const phone = $('#phone').val();
            const address = $('#address').val();

            if (!name || !phone || !address) {
                alert('Please fill in all required fields');
                return false;
            }

            // Disable the submit button and change text
            submitButton.prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin"></i> Processing...');

            // Enable the button after 30 seconds (failsafe in case of network issues)
            // setTimeout(function() {
            //     submitButton.prop('disabled', false)
            //                .html('অর্ডার কনফার্ম করুন');
            // }, 30000);

            // return true;
        });

        function updateTotal() {
            const selectedProduct = $('input[name="slug"]:checked');
            const selectedShipping = $('input[name="shipping_id"]:checked');

            // Get prices from the product-price and shipping-price divs
            let productPrice = 0;
            let shippingPrice = 0;

            if (selectedProduct.length) {
                productPrice = parseFloat(selectedProduct.closest('.product-option')
                    .find('.product-price').text().replace('৳', '').replace(',', '')) || 0;
            }

            if (selectedShipping.length) {
                shippingPrice = parseFloat(selectedShipping.closest('.shipping-option')
                    .find('.shipping-price').text().replace('৳', '').replace(',', '')) || 0;
            }

            if (isNaN(productPrice) || isNaN(shippingPrice)) {
                console.error('Invalid price values detected');
                return;
            }

            console.log('Product Price:', productPrice, 'Shipping Price:', shippingPrice);
            const total = productPrice + shippingPrice;

            $('#subtotal').text('৳' + productPrice.toFixed(2));
            $('#shipping-cost').text(shippingPrice === 0 ? 'Free' : '৳' + shippingPrice.toFixed(2));
            $('#total').text('৳' + total.toFixed(2));

            // Update hidden inputs
            $('#productPrice').val(productPrice);
            $('#shippingCost').val(shippingPrice);
        }

        // Handle product selection
        $('input[name="slug"]').change(function() {
            const productName = $(this).closest('.product-option').find('.product-title').text();
            $('#selectedProductName').text(productName);
            $('#productName').val(productName);
            updateTotal();
        });

        // Handle shipping selection
        $('input[name="shipping_id"]').change(function() {
            updateTotal();
        });

        $('.faq-question').click(function() {
            // Toggle active class on question
            $(this).toggleClass('active');

            // Toggle show class on answer
            $(this).next('.faq-answer').toggleClass('show');

            // Close other open FAQs (optional)
            $('.faq-question').not(this).removeClass('active');
            $('.faq-answer').not($(this).next()).removeClass('show');
        });
    });
</script>
@endpush


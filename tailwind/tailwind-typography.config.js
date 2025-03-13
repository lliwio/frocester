// Copied from Tailwind Typography.
const hexToRgb = (hex) => {
	if (typeof hex !== 'string' || hex.length === 0) {
		return hex;
	}

	hex = hex.replace('#', '');
	hex = hex.length === 3 ? hex.replace(/./g, '$&$&') : hex;
	const r = parseInt(hex.substring(0, 2), 16);
	const g = parseInt(hex.substring(2, 4), 16);
	const b = parseInt(hex.substring(4, 6), 16);
	return `${r} ${g} ${b}`;
};

module.exports = {
	theme: {
		extend: {
			typography: (theme) => ({
				/**
				 * Tailwind Typography’s default styles are opinionated, and
				 * you may need to override them if you have mockups to
				 * replicate. You can view the default modifiers here:
				 *
				 * https://github.com/tailwindlabs/tailwindcss-typography/blob/master/src/styles.js
				 */

				DEFAULT: {
					css: [
						{
							/**
							 * By default, max-width is set to 65 characters.
							 * This is a good default for readability, but
							 * often in conflict with client-supplied designs.
							 * A value of false removes the max-width property.
							 */
							maxWidth: false,
							fontSize: '1.2rem',
							// Set Open Sans as the default font family.
							fontFamily: {
								body: ['"Open Sans"', 'sans-serif'],
							},

							// Apply Open Sans with appropriate font weights.
							h1: {
								fontWeight: '700', // Bold
							},
							h2: {
								fontWeight: '700', // Bold
								marginTop: '0',
								marginBottom: '1rem',
							},
							h3: {
								fontWeight: '700', // Bold
							},
							h4: {
								fontWeight: '700', // Bold
							},
							p: {
								fontWeight: '400', // Regular
							},
							a: {
								fontWeight: '400', // Regular
							},
							strong: {
								fontWeight: '700', // Bold
							},
							blockquote: {
								fontWeight: '400', // Regular
							},
							'.wp-block-button__link': {
								fontWeight: '700',
								'text-decoration': 'none',
								'&:hover': {
									backgroundColor: theme('colors.foreground'),
									color: theme('colors.yellow'),
								},
							},
							'ul': {
							listStyleType: 'square',
							paddingLeft: '1rem !important',
							},
							'.has-foreground-background-color .wp-block-button__link': {
								border: `1px solid ${theme('colors.yellow')}`,
							},
							'.has-yellow-background-color .wp-block-button__link': {
								border: `1px solid ${theme('colors.foreground')}`,
								'&:hover': {
									backgroundColor: `${theme('colors.yellow')} !important`,
									color: `${theme('colors.foreground')} !important`,
								},
							},
							blockquote: {
								position: 'relative',
								padding: '0.1rem 3rem 2rem 7rem',
								marginLeft: '0',
								marginRight: '0',
								color: theme('colors.yellow'),
								borderLeftWidth: '0',
								backgroundColor: theme('colors.foreground'),
								
								'&::before': {
								  content: '""',
								  position: 'absolute',
								  left: '2rem',
								  top: '0rem',
								  width: '50px',
								  height: '50px',
								  backgroundImage: `url('./img/quote.svg')`,
								  backgroundSize: 'contain',
								  backgroundRepeat: 'no-repeat',
								  backgroundPosition: 'center',
								},

								cite: {
									fontStyle: 'normal',
									color: theme('colors.white'),
									fontWeight: 'bold',
									display: 'block',
									marginTop: '1rem',
								  },
							},
						},
					],
				},

				/**
				 * By default, _tw uses Tailwind Typography’s Neutral gray
				 * scale. If you are adapting an existing design and you need
				 * to set specific colors throughout, you can do so here. In
				 * your `./theme/functions.php file, you will need to replace
				 * `prose-neutral` with `prose-frocester`.
				 */
				frocester: {
					css: {
						'--tw-prose-body': theme('colors.foreground'),
						'--tw-prose-headings': theme('colors.foreground'),
						'--tw-prose-lead': theme('colors.foreground'),
						'--tw-prose-links': theme('colors.foreground'),
						'--tw-prose-bold': theme('colors.foreground'),
						'--tw-prose-counters': theme('colors.yellow'),
						'--tw-prose-bullets': theme('colors.yellow'),
						'--tw-prose-hr': theme('colors.foreground'),
						'--tw-prose-quotes': theme('colors.foreground'),
						'--tw-prose-quote-borders': theme('colors.primary'),
						'--tw-prose-captions': theme('colors.foreground'),
						'--tw-prose-kbd': theme('colors.foreground'),
						'--tw-prose-kbd-shadows': hexToRgb(
							theme('colors.foreground')
						),
						'--tw-prose-code': theme('colors.foreground'),
						'--tw-prose-pre-code': theme('colors.background'),
						'--tw-prose-pre-bg': theme('colors.foreground'),
						'--tw-prose-th-borders': theme('colors.foreground'),
						'--tw-prose-td-borders': theme('colors.foreground'),
						'--tw-prose-invert-body': theme('colors.background'),
						'--tw-prose-invert-headings':
							theme('colors.background'),
						'--tw-prose-invert-lead': theme('colors.background'),
						'--tw-prose-invert-links': theme('colors.primary'),
						'--tw-prose-invert-bold': theme('colors.background'),
						'--tw-prose-invert-counters': theme('colors.primary'),
						'--tw-prose-invert-bullets': theme('colors.primary'),
						'--tw-prose-invert-hr': theme('colors.background'),
						'--tw-prose-invert-quotes': theme('colors.background'),
						'--tw-prose-invert-quote-borders':
							theme('colors.primary'),
						'--tw-prose-invert-captions':
							theme('colors.background'),
						'--tw-prose-invert-kbd': theme('colors.background'),
						'--tw-prose-invert-kbd-shadows': hexToRgb(
							theme('colors.background')
						),
						'--tw-prose-invert-code': theme('colors.foreground'),
						'--tw-prose-invert-pre-code':
							theme('colors.background'),
						'--tw-prose-invert-pre-bg': 'rgb(0 0 0 / 50%)',
						'--tw-prose-invert-th-borders':
							theme('colors.background'),
						'--tw-prose-invert-td-borders':
							theme('colors.background'),
					},
				},
			}),
		},
	},
};

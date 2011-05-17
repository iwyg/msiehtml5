<?php

	Class extension_msiehtml5 extends Extension{

		public function about(){
			return array(
				'name' => 'MsieHtml5',
				'type'	=> 'output',
				'version' => '1',
				'release-date' => '2011-03-03',
				'author' => array(
					'name' => 'Thomas Appel'
				),
				'description' => 'Replace XHTML syntax with basic HTML5 syntax.',
				'compatibility' => array(
					'2.1.2' => true,
					'2.2' => true
				)
			);
		}

		public function getSubscribedDelegates(){
			return array(
				array(
					'page' => '/frontend/',
					'delegate' => 'FrontendOutputPostGenerate',
					'callback' => 'postprocess_html'
				),
			);
		}
		protected function checkmsie() {			
			//check if IE 8 or lower			
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);			
			if(strpos($ua,'msie') !== FALSE) {
				if(strpos($ua,'opera') == FALSE) {
					if(preg_match('/(?i)msie [1-8]/',$ua)) {
						return true;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}						
		}
		public function postprocess_html($context) {
			// Parse only if $context['output'] exists and it's an HTML document			
			if(self::checkmsie()) {
				$html = $context['output'];

				$html = preg_replace('/<(html) /', '<$1 xmlns="http://www.w3.org/1999/xhtml" xmlns:html5="http://www.w3.org/1999/xhtml"', $html);			
				// Parse document and put html5 tags in their own namespace
				$html = preg_replace('/<(\/?)(abbr|article|aside|audio|canvas|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video)/', '<$1html5:$2', $html);

				$context['output'] = $html;
			}
		}

	}

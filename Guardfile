# A sample Guardfile
# More info at https://github.com/guard/guard#readme

guard 'compass' do
	watch /^.+(\.s[ac]ss)/
end

input_files = %w(
	foundation/modernizr.foundation
	foundation/jquery
	foundation/jquery.event.move
	foundation/jquery.event.swipe
	foundation/jquery.foundation.buttons
	foundation/jquery.foundation.clearing
	foundation/jquery.foundation.forms
	foundation/jquery.foundation.mediaQueryToggle
	foundation/jquery.foundation.reveal
	foundation/jquery.foundation.tooltips
	foundation/jquery.foundation.topbar
	foundation/jquery.placeholder
	foundation/app
	jquery.foundation.accordion.modified
	jquery.foundation.orbit.modified
	jquery.foundation.navigation.modified
	jquery.menu-aim
	jquery.accordion
	holder
	jquery.lazyload
	spin
	jquery.spin
	site
)
# This will concatenate the javascript files specified in :files to public/js/all.js
guard :concat, type: "js", files: input_files, input_dir: "javascripts", output: "javascripts/all"

#guard :concat, type: "css", files: %w(), input_dir: "public/css", output: "public/css/all"

guard 'uglify', :input => "javascripts/all.js", :output => "javascripts/all.min.js" do
  watch ('javascripts/all.js')
end

guard 'livereload' do
	watch /.+\.php/
	watch /.+\.css/
	watch /.+\.js/
end

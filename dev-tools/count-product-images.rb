require 'nokogiri'
require 'php_serialize'

doc = Nokogiri::XML(open('mystore.wordpress.2013-04-19.xml'))

puts doc.css('wp|postmeta').count

doc.css('wp|postmeta').each do |postmeta|
	meta_key = postmeta.at_css('wp|meta_key')
	if meta_key.content.eql?('key')
		#puts meta_key
		meta_value = postmeta.at_css('wp|meta_value')
		#puts meta_value.content
		unserialized = PHP.unserialize(meta_value.content)
		new_values = {}
		#puts unserialized	
		image_found = 0
		unserialized.each do |values|
			if values[0].include?('productimage')
				values[1] = values[1].sub('http://localhost/wordpress','http://rr.id1945.com')
				#puts values.to_s
				if !values[1].empty?
					image_found += 1
				end
			end
			new_values.store(values[0], values[1])
		end
		if image_found > 4
			puts new_values
		end
		#puts new_values
		serialized = PHP.serialize(new_values)
		#puts serialized
		meta_value.content = serialized
		#puts meta_value.content
	end
end


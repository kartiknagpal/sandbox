class MyClass:
	"""DocString for the MyClass"""
	#class variables
	num_of_instances = 0

	#constructor
	def __init__(self,x,y):
		#instance variables
		self.x = x
		self.y = y
		MyClass.num_of_instances += 1

	#instance method
	def my_method(self):
		return (self.x+self.y)

	@staticmethod
	def count_instances():
		return MyClass.num_of_instances


def main():
	obj_ref = MyClass(1,2)
	sum = obj_ref.my_method()
	print(str(sum))

	obj_ref1 = MyClass(2,3)
	print(str(MyClass.my_method(obj_ref1)))

	print(str(MyClass.count_instances()))

if __name__ == '__main__':
	main()
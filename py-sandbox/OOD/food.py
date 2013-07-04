class Fridge:
	"""
	This class implements a fridge where ingredients can be added and removed individually,
	or in groups.
	The fridge will retain a count of every ingredient added or removed, and will raise an error
	if a sufficient quantity of ingredient isn't present.
	Methods:
	has(food_name[, quantity]) - checks if the string food_name is in the fridge, quantity defaults 
								 to 1
	has_various(foods) - checks if enough of every food in the dictionary is in the fridge
	add_one(food_name) - add a single food_name to the fridge
	add_many(food_dict) - adds a whole dictionary filled with food
	get_one(food_name) - takes out a single food_name from the fridge
	get_many(food_dict) - takes out a whole dictionary worth of food_name
	get_ingredients(food) - If passed an object that has the __ingredients__
							method, get_many will invoke this to get the list of ingredients
	"""
	def __init__(self,items={}):
		"""Optionally pass in an initial dictionary of items"""
		if type(items) != type({}):
			raise TypeError("Fridge requires a dictionary but was given %s"%type(items))
		self.items = items

	def __add_multi(self,food_name,quantity):
		"""__add_multi(food_name,quantity) - adds more than one of a food item. Returns the number of
		items added
		This should only be used internally, after the type checking has been done
		"""
		if (not food_name in self.items):
			self.items[food_name] = 0
		self.items[food_name] += quantity

	def add_one(self,food_name):
		"""
		add_one(food_name) - add a single food_name to the fridge
		reurns True
		Raises TypeError if food_name is not a string.
		"""
		if type(food_name)!=type(""):
			raise TypeError("add_one requires a string, given a %s type"%type(food_name))
		else:
			self.__add_multi(food_name,1)
		return True

	def add_many(self,food_dict):
		"""
		add_many(food_dict) - adds a whole dictionary filled with food as keys and quantities as
		values.
		returns a dictionary with the removed food.
		raises a TypeError if food_dict is not a dictionary
		returns False if there is not enough food in the fridge
		"""
		if type(food_dict)!=type({}):
			raise TypeError("add_many requires a dictionary, given a %s type"%type(food_dict))
		for item in food_dict.keys():
			self.__add_multi(item,food_dict[item])
		return

	def __has_multi(self,food_name,quantity):
		"""
		This should only be used internally, after the type checking has been done
		"""
		try:
			if self.items[food_name]>=quantity:
				return True
		except KeyError:
			return False
			

	def has(self,food_name,quantity=1):
		"""
		has(food_name[, quantity]) - checks if the string food_name is in the fridge, quantity defaults 
								 to 1
		Returns True if there is enough otherwise False.
		"""
		if (type(food_name)!=type("")) or (type(quantity)!=type(1)):
			raise TypeError("Expected a string and Optionally a integer, given %s and %s"\
				%(food_name,quantity))
		if quantity<1:
			raise ValueError("quantity must be greater than or equal to 1, given %d"%quantity)

		return (self.__has_multi(food_name,quantity))

	def has_various(self,foods,quantity=1):
		"""
		has_various(foods) - checks if enough of every food in the dictionary is in the fridge
		"""
		if (type(foods)!=type({})) or (type(quantity)!=type(1)):
			raise TypeError("Expected a string and Optionally a integer, given %s and %s"\
				%(foods,quantity))
		if quantity<1:
			raise ValueError("quantity must be greater than or equal to 1, given %d"%quantity)

		for food_name in foods.keys():
			if not self.__has_multi(food_name,quantity):
				return False
		return True


class Omelet:
	"""
	This class creates an omelet object. An omelet can be in one of two states: ingredients, or
	cooked.
	An omelet object has the following interfaces:
	get_kind() - returns a string with the type of omelet
	set_kind(kind) - sets the omelet to be the type named
	set_new_kind(kind, ingredients) - lets you create an omelet
	mix() - gets called after all the ingredients are gathered from the fridge
	cook() - cooks the omelet
	"""
	def __init__(self,kind="cheese"):
		"""__init__(self, kind="cheese")
		This initializes the Omelet class to default to a cheese omelet.
		Other methods
		"""
		self.set_kind(kind)
		return
	def __ingredients__(self):
		"""Internal method to be called on by a fridge or other objects that need to act on
		ingredients.
		"""
		return self.needed_ingredients
	
	def get_kind(self):
		return self.kind

	def set_kind(self,kind):
		possible_ingredients = self.__known_kinds(kind)
		if possible_ingredients == False:
			return False
		else:
			self.kind = kind
			self.needed_ingredients = ingredients

	def set_new_kind(self,name,ingredients):
		self.kind = name
		self.needed_ingredients = ingredients
		return

	def __known_kinds(self,kind):
		if kind=="cheese":
			return {"eggs":2,"milk":1,"cheese":1}
		if kind=="mushroom":
			return {"eggs":2,"milk":1,"cheese":1,"mushroom":2}
		if kind=="onion":
			return {"eggs":2,"milk":1,"cheese":1,"onion":1}
		else:
			return False

	def get_ingredients(self,fridge):
		self.from_fridge = fridge.get_ingredients(self)

	def mix(self):
		for ingredient in self.from_fridge.keys():
			print("Mixing %d %s for the %s the omelet"%\
				(self.from_fridge[ingredient],ingredient,self.kind))
		self.mixed = True

	def make(self):
		if self.mixed == True:
			print("Cooking the %s omelet!"%self.kind)
			self.cooked = True
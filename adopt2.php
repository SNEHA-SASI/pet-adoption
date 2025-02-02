<form method="POST" action="process_adopt.php">
    <!-- Form fields here -->
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required>
    
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="petChoice">Choose a Pet:</label>
    <select id="petChoice" name="petChoice" required>
        <option value="">-- Select a Pet --</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
        <option value="Rabbit">Rabbit</option>
        <option value="Cow">Cow</option>
        <option value="Birds">Birds</option>
        <option value="Goat">Goat</option>
    </select>
    
    <button type="submit">Submit Adoption Request</button>
</form>

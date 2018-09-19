from haversine import haversine

class HaversineCoverage:
    DISTANCE = 10
    locations = []
    shoppers = []

    def __init__(self, locations = [], shoppers = []):
        self.locations = locations
        self.shoppers = shoppers

    # Get shoppers' coverage list
    def get_coverage(self):
        locations_count = len(self.locations)
        coverage = []

        for shopper in self.shoppers:
            covered_count = 0

            # Only for enabled shoppers
            if shopper['enabled']:
                for location in self.locations:
                    # Check if this location is covered
                    is_covered = self.__is_covered((shopper['lat'], shopper['lng']), (location['lat'], location['lng']))
                    covered_count += 1 if is_covered else 0

                # Calculate coverage of the shopper
                coverage.append({'shopper_id': shopper['id'], 'coverage': (covered_count * 100 / locations_count)})

        coverage.sort(cmp=None, key=lambda r: r['coverage'], reverse=True)
        return coverage

    # Check if a shopper covers a certain point
    def __is_covered(self, coords1 = (), coords2 = ()):
        return haversine(coords1, coords2) < HaversineCoverage.DISTANCE
